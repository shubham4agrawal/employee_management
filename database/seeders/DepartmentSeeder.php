<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departments = ['IT Support', 'HR', 'RTB', 'Marketing', 'Bizdev',
            'Management', 'Engineering', 'Analytics'];
        foreach ($departments as $dept) {
            DB::table('departments')->insert([
                'name' => $dept,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

    }
}
