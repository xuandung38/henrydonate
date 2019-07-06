<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoryTransaction extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('streamer_infos')->insert([
            'user_id' => 1,
            'name' => Str::random(10),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('history_transactions')->insert([
            'user_id' => 1,
            'telcode' => Str::random(10),
            'code' => Str::random(10),
            'serial' => Str::random(10),
            'price' => 10000,
            'message' => "đang chờ duyệt",
            'donate_message' => "test donate",
            'streamer_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
