<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Division;
use App\Models\Cluster;
use App\Models\Position;
use App\Models\Insurance;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Pakai locale Indonesia
        $faker = Faker::create('id_ID');

        $divisionIds = Division::pluck('id')->toArray();
        $clusterIds = Cluster::pluck('id')->toArray();
        $positionIds = Position::pluck('id')->toArray();
        $insurancIds = Insurance::pluck('id')->toArray();

        // Kota di Kalimantan
        $kalimantanCities = [
            'Pontianak',
            'Samarinda',
            'Balikpapan',
            'Banjarmasin',
            'Palangkaraya',
            'Tanjung Selor',
            'Singkawang',
            'Tarakan',
            'Ketapang',
            'Bontang',
            'Banjarbaru'
        ];

        foreach (range(1, 50) as $i) {
            $status = $faker->randomElement(['active', 'inactive', 'freelance', 'resigned']);
            $joinDate = $faker->dateTimeBetween('-5 years', 'now')->format('Y-m-d');
            $resignDate = ($status === 'resigned')
                ? $faker->dateTimeBetween($joinDate, 'now')->format('Y-m-d')
                : null;

            DB::table('employees')->insert([
                'full_name'             => $faker->name,
                'ktp_number'            => $faker->numerify('################'), // 16 digit KTP
                'employee_code'         => strtoupper($faker->unique()->bothify('EMP###')),
                'birth_place'           => $faker->randomElement($kalimantanCities),
                'birth_date'            => $faker->date('Y-m-d', '2000-12-31'),
                'address_ktp'           => $faker->streetAddress . ', ' . $faker->city . ', ' . $faker->state,
                'address_domicile'      => $faker->streetAddress . ', ' . $faker->city . ', ' . $faker->state,
                'phone_number'          => '08' . $faker->numerify('##########'), // format Indo
                'email'                 => $faker->unique()->safeEmail,

                'division_id'           => $faker->randomElement($divisionIds),
                'cluster_id'            => $faker->randomElement($clusterIds),
                'position_id'           => $faker->randomElement($positionIds),

                'status_employee'       => $status,
                'join_date'             => $joinDate,
                'resign_date'           => $resignDate,

                'bank_account_number'   => $faker->numerify('##########'),
                'bank_name'             => $faker->randomElement(['BCA', 'BRI', 'Mandiri', 'BNI', 'BSI', 'BTN']),
                // 'insurance_id'    => $faker->randomElement($insurancIds),

                'created_at'            => now(),
                'updated_at'            => now(),
            ]);
        }
    }
}
