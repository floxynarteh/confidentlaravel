<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->delete();
        DB::table('orders')->insert([
            ['user_id' =>1,
            'product_id' => \App\Models\Product::FULL,
            'stripe_id' => 'initialjmaccount',
            'total' => 0],

            ['user_id' =>2,
            'product_id' => \App\Models\Product::FULL,
            'stripe_id' => 'floxyaccount',
            'total' => 0]
        ]);
    }
}
