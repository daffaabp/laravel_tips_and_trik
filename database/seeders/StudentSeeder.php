<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Schema::disableForeignKeyConstraints();
        // Student::truncate();
        // Schema::enableForeignKeyConstraints();

        // $data = [
        //     ['name' => 'Daffa Budi Prasetya', 'gender' => 'L', 'nis' => '210102005', 'class_id' => 1],
        //     ['name' => 'Adhelia Finosita Anestri', 'gender' => 'P', 'nis' => '210202001', 'class_id' => 2],
        //     ['name' => 'Fria Nurul Muafiyati', 'gender' => 'P', 'nis' => '210102007', 'class_id' => 3],
        //     ['name' => 'Niqi Zarani Monica Putri', 'gender' => 'P', 'nis' => '210202009', 'class_id' => 4],
        // ];

        // foreach ($data as $value) {
        //     Student::insert([
        //         'name' => $value['name'],
        //         'gender' => $value['gender'],
        //         'nis' => $value['nis'],
        //         'class_id' => $value['class_id'],
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }

        Student::factory()->count(20)->create();

    }
}
