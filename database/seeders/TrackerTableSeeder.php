<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrackerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('trackers')->insert([
            [
                'name' => 'Defect'
            ],
            [
                'name' => 'Feature'
            ],
            [
                'name' => 'Patch'
            ],
        ]);
    }
}
