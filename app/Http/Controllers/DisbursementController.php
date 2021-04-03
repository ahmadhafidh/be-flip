<?php

namespace App\Http\Controllers;

use App\Services\DisbursementService;
use Illuminate\Http\Request;

class DisbursementController extends Controller
{
    private $service = null;

    public function __construct()
    {
        $this->service = new DisbursementService();
    }

    public function index(Request $request)
    {
        $data = $this->service->index($request);

        return view('index', [ 'data' => $data ]);
    }
}
