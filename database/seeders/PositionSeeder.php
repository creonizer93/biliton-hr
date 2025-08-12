<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Position;

class PositionSeeder extends Seeder
{
    public function run(): void
    {
        $positions = ['HR', 'Manager', 'Admin_Cluster', 'Leader', 'MBP', 'Maintenance', 'ETS'];
        foreach ($positions as $name) {
            Position::create(['name' => $name]);
        }
    }
}
