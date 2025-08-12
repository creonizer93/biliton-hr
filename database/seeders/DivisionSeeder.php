<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = ['ENOM', 'FLM', 'Icon Plus', 'Mabes', 'Project DMT', 'Project Mix'];
        foreach ($divisions as $name) {
            Division::create(['name' => $name]);
        }
    }
}
