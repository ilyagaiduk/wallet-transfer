<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Balance extends Model
{
    public function UserBalance($id) {
        $balance = DB::table('balance')
            ->where('user_id', '=', $id)
            ->first();
        return $balance;
    }
    public function transfer($amount, $id, $source_id) {
        $balance = DB::table('balance')
            ->where('user_id', '=', $id)
            ->update([
                'score' => DB::raw('score + '.$amount),
            ]);
        $sourceBalance = DB::table('balance')
            ->where('user_id', '=', $source_id)
            ->update([
                'score' => DB::raw('score - '.$amount),
            ]);
        return "Баланс пополнен";
    }
    public function refill($amount, $id) {
        $balance = DB::table('balance')
            ->where('user_id', '=', $id)
            ->update([
                'score' => DB::raw('score + '.$amount),
            ]);
        return "Баланс пополнен";
    }
    public function withdrawal($amount, $id) {
        $balance = DB::table('balance')
            ->where('user_id', '=', $id)
            ->update([
                'score' => DB::raw('score - '.$amount),
            ]);
        return "Деньги сняты";
    }
}
