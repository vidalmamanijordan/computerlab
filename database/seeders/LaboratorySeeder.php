<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{

    public function run()
    {
        Laboratory::create([
            'name' => 'Laboratorio Redes',
            'description' => 'Laboratorios Especializado de Redes y Conectividad'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio Software',
            'description' => 'Laboratorios Especializado de Software'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio 4',
            'description' => 'Laboratorio 4, Subdirección de texnologías e información'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio 2',
            'description' => 'Laboratorio 2, Subdirección de texnologías e información'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio 5',
            'description' => 'Laboratorio 5, Subdirección de texnologías e información'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio 6',
            'description' => 'Laboratorio 6, Subdirección de texnologías e información'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio 7',
            'description' => 'Laboratorio 7, Subdirección de texnologías e información'
        ]);

        Laboratory::create([
            'name' => 'Laboratorio 8',
            'description' => 'Laboratorio 8, Subdirección de texnologías e información'
        ]);
    }
}
