<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DisbursementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DisbursementController extends Controller
{
    private $service = null;
    private $flipRequest = null;
    private $baseUrl = null;

    public function __construct()
    {
        $this->service = new DisbursementService();
        $this->baseUrl = 'https://nextar.flip.id';
        $this->flipRequest = Http::withBasicAuth('HyzioY7LP6ZoO7nTYKbG8O4ISkyWnX1JvAEVAhtWKZumooCzqp41', '')
            ->withHeaders([
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store(Request $request)
    {
        $validation = $this->service->validate($request);

        if($validation->fails()) {
            return response()->json($validation->errors())->setStatusCode(422);
        }

        $response = $this->flipRequest->post($this->baseUrl.'/disburse', [
            'bank_code' => $request->get('bank_code'),
            'account_number' => $request->get('account_number'),
            'amount' => $request->get('amount'),
            'remark' => $request->get('remark')
        ]);

        if ($response->status() == 200) {
            $result = $response->json();

            return $this->service->store($request, $result);
        }

        return $response->json();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show($id)
    {
        $response = $this->flipRequest->get($this->baseUrl.'/disburse/'.$id);

        if ($response->status() == 200) {
            $result = $response->json();

            return $this->service->update($id, $result);
        }

        return $response->json();
    }
}
