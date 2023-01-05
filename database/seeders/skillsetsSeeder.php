<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class skillsetsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill_sets = [
            [
                'candidates_id' => "1",
                'skill_id' => "2"
               
            ],
            [
                'candidates_id' => "1",
                'skill_id' => "1"
            ],
            [
                'candidates_id' => "2",
                'skill_id' => "1"
            ],
            [
                'candidates_id' => "2",
                'skill_id' => "2"
            ]

        ];
        \DB::table('skill_sets')->insert($skill_sets);
    }
}
