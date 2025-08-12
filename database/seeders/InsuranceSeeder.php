<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Insurance;
use App\Models\Employee;
use Faker\Factory as Faker;

class InsuranceSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Loop semua karyawan agar setiap karyawan punya data insurance
        foreach (Employee::all() as $employee) {
            Insurance::create([
                'employee_id' => $employee->id,
                'bpjs_health_number' => $faker->numerify(str_repeat('#', 13)), // 13 digit
                'bpjs_health_join_date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'bpjs_tk_number' => $faker->numerify(str_repeat('#', 11)), // 11 digit
                'bpjs_tk_join_date' => $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            ]);
        }
    }
}
