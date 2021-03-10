<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();
        DB::table('products')->insert([
            [
            'name' => 'Starter',
            'price' => 89,
            'ordinal' =>1],

            [
            'name' => 'Master',
            'price' => 149,
            'ordinal' =>2],
        ]);
    }
}
