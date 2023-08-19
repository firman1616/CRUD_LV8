<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'nama' => 'Moch. Firman Firdaus',
            'jenis_kelamin' => 'pria',
            'no_telp' => '089666515952'
        ]);
    }
}
