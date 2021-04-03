<?php

namespace App\Services;

use App\Models\Disbursement;
use Illuminate\Http\Request;
use Validator;

class DisbursementService
{
    public $insertValidation = [
        'bank_code' => 'required',
        'account_number' => 'required',
        'amount' => 'required|numeric|min:1000',
        'remark' => 'required',
    ];

    public $attributes = [
        'bank_code' => 'Bank Code',
        'account_number' => 'Account Number',
        'amount' => 'Amount',
        'remark' => 'Remark',
    ];


    public function index(Request $request)
    {
        return Disbursement::orderBy('timestamp', 'desc')->paginate(5);
    }

    public function validate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $this->insertValidation,
            [],
            $this->attributes
        );

        return $validator;
    }

    public function store(Request $request, $result)
    {
        $data = Disbursement::create([
            'id' => $result['id'],
            'bank_code' => $result['bank_code'],
            'account_number' => $result['account_number'],
            'amount' => $result['amount'],
            'remark' => $result['remark'],
            'timestamp' => $result['timestamp'],
            'beneficiary_name' => $result['beneficiary_name'],
            'status' => $result['status'],
            'receipt' => $result['status'],
            'time_served' => null,
            'fee' => $result['fee'],
        ]);

        return $data;
    }

    public function update($id, $result)
    {
        $data = Disbursement::find($id);

        if (!$data) {
            return 'Cannot Find Row';
        }

        $data->remark = $result['remark'];
        $data->status = $result['status'];
        $data->receipt = $result['receipt'];
        $data->time_served = $result['time_served'];

        $data->save();

        if (!$data) {
            return response('Error', 500);
        }

        return response()->json($data);
    }
}
