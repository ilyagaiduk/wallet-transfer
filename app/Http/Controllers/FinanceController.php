<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Balance;

class FinanceController extends Controller
{
    public function users()
    {
        return new User();
    }

    public function balance()
    {
        return new Balance();
    }
    public function transfer(Request $request) {
        if ($request->isMethod('post')) {
            $source_address = $request->post('source');
            $target_address = $request->post('id');
            $amount = $request->post('amount');
            $currBalance = $this->balance()->UserBalance($target_address);
            $validated = $request->validate([
                'id' => 'required',
                'amount' => 'required|numeric|between:0.00,'.$currBalance->score,
            ]);
            $transfer = $this->balance()->transfer($amount, $target_address, $source_address);
            $data = "Осуществлен перевод на сумму $amount от пользователя $source_address пользователю $target_address";
            return redirect()->route('admin.user', $source_address)->with( ['data' => $data] );
        }
    }
    public function refill(Request $request) {
        if ($request->isMethod('post')) {
            $target_address = $request->post('id');
            $source_address = $request->post('source');
            $amount = $request->post('amount');
            $currBalance = $this->balance()->UserBalance($target_address);
            $validated = $request->validate([
                'id' => 'required',
                'amount' => 'required|numeric|between:0.00,'.$currBalance->score,
            ]);
            $transfer = $this->balance()->refill($amount, $target_address);
            $data = "Кошелек пользователя $target_address пополнен на сумму $amount";
            return redirect()->route('admin.user', $source_address)->with( ['data' => $data] );
        }
    }
    public function withdrawal(Request $request)
    {
        if ($request->isMethod('post')) {
            $source_address = $request->post('source');
            $amount = $request->post('amount');
            $currBalance = $this->balance()->UserBalance($source_address);
            $validated = $request->validate([
                'amount' => 'required|numeric|between:0.00,' . $currBalance->score,
            ]);
            $transfer = $this->balance()->withdrawal($amount, $source_address);
            $data = "С кошелька пользователя $source_address снята сумма $amount";
            return redirect()->route('admin.user', $source_address)
                ->with(['data' => $data]);
        }
    }

}
