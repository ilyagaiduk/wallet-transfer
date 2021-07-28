<?php

use Illuminate\Database\Seeder;

class BalanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  DB::table('users')
                    ->get();
        foreach($users as $value) {
            DB::table('balance')
                ->insert([
                'user_id' => $value->id,
                'score' => 1000,
            ]);
        }
    }
}
