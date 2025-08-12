<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cluster;

class ClusterSeeder extends Seeder
{
    public function run(): void
    {
        $clusters = ['Jakarta', 'Banjarmasin', 'Banua Enam', 'Batulicin', 'Kalsel', 'Kaltim', 'Kalteng', 'Kaltara'];
        foreach ($clusters as $name) {
            Cluster::create(['name' => $name]);
        }
    }
}
