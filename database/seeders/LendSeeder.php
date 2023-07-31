<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LendSeeder extends Seeder
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
            $product = new \App\Models\Lend([
                'member_id' => $i,
                'stock_id' => $i,
                'lend_date' => '20'. $i .'-09-07',
                'due_date' =>  '20'. $i .'-09-27',
            ]);
            $product->save();
        }
    }
}