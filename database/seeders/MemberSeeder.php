<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
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
            $product = new \App\Models\Member([
                'name' => 'サンプルユーザー' . $i,
                'email' => 'penguin' . $i . '@courier.co.jp',
                'address' => '東京都新宿区百人町' .$i . '-'.$i + rand(1,20) . '-'.$i + rand(1,10). '-',
                'tel' => '1234567890',
                'birthday' => '20'. $i .'-09-07',
                'deleted_at' => '20'. $i .'-11-27',
            ]);
            $product->save();
        }
    }
}
