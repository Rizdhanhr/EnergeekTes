<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class skillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skill = [
            [
                'name' => "PHP",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "Postgree SQL",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "CodeIgniter",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ],
            [
                'name' => "NodeJS",
                'created_at' => new \DateTime,
                'updated_at' => null,
                'created_by' => "1",
                'updated_by' => "1"
            ]

        ];
        \DB::table('skills')->insert($skill);
    }
}
