<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
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
            $product = new \App\Models\Document([
                // ランダムに設定したい場合は
                // 'ISBN_number' => substr(str_shuffle("012345678901234567890123456789"), 0, 13),
                // 他のテーブルと連携する時は
                'ISBN_number' => 1111111111110 + $i,
                'document_name' => ''. $i . '世紀のパリ',
                'code' => rand(1,9),
                'author' => 'カバーラップ' . $i . '世',
                'publisher' => '徳間書店',
                'publisher_date' => '20'. $i .'-09-07',
                
            ]);
            $product->save();
        }
    }
}
