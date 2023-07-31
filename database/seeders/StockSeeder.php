<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 99; $i++) {
            $product = new \App\Models\Stock([
                // ランダムに設定したい場合は
                // 'ISBN_number' => substr(str_shuffle("012345678901234567890123456789"), 0, 13),
                // 他のテーブルと連携する時は
                'ISBN_number' => 1111111111110 + $i,
                'arrival_date' => '20'. $i .'-09-07',
                // 'waste_date' => '20'. $i .'-11-27',
                // 'remark' => '割れ物注意',
            ]);
            $product->save();
        }
    }
}
