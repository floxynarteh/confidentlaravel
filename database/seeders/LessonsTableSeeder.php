<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lessons')->delete();
        DB::table('lessons')->insert([
            'name' => 'Start Testing',
              'ordinal' => 1
              ]);


      DB::table('lessons')->insert([
            ['name' => 'Testing Application Code',
            'ordinal' => 2,
            'product_id' => 1],

            ['name' => 'Testing Integrations',
            'ordinal' => 3,
            'product_id' => 1],

            ['name' => 'Testing Additional Classes',
            'ordinal' => 4,
            'product_id' => 1],

            ['name' => 'Testing Tactics',
            'ordinal' => 5,
            'product_id' => 2],

            ['name' => 'Group Q&A Calls',
            'ordinal' => 6,
            'product_id' => 2],

                    ]);

    }
}
