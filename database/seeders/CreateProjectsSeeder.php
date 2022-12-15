<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CreateProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::insert([
            [
                'name' => 'BOILERS',
                'slug' => Str::slug('BOILERS'),
            ],
            [
                'name' => 'PHOTOVOLTAÏQUES',
                'slug' => Str::slug('PHOTOVOLTAÏQUES'),
            ],
            [
                'name' => 'POMPES A CHALEUR',
                'slug' => Str::slug('POMPES A CHALEUR'),
            ],
            [
                'name' => 'BORNES DE RECHARGE',
                'slug' => Str::slug('BORNES DE RECHARGE'),
            ]
        ]);
    }
}
