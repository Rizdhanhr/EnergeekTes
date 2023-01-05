<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class jobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'name' => "Fullstack Developer",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "FrontEnd Developer",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "Accounting",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "Android Developer",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ]

        ];
        \DB::table('jobs')->insert($jobs);
    }
}
