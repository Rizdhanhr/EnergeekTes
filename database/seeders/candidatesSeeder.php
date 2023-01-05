<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class candidatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $candidates = [
            [
                'name' => "Rizdhan Hernanda",
                'job_id' => "1",
                'email' => "Rizdhanhr@gmail.com",
                'phone' => "082338938580",
                'year' => "1999",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "Jarwo",
                'job_id' => "2",
                'email' => "jarwokuat@gmail.com",
                'phone' => "0823389123",
                'year' => "1999",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "Clarisa",
                'job_id' => "2",
                'email' => "Clarisacantik@gmail.com",
                'phone' => "08123456789",
                'year' => "1999",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ]

        ];
        \DB::table('candidates')->insert($candidates);
    }
}
