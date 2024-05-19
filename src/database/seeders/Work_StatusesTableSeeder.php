<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Work_StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $param = [
            'status' => '1',
            ];
            DB::table('work_statuses')->insert($param);
            $param = [
            'status' => '2',
            ];
            DB::table('work_statuses')->insert($param);
            $param = [
            'status' => '3',
            ];
            DB::table('work_statuses')->insert($param);
            $param = [
                'status' => '4',
                ];
                DB::table('work_statuses')->insert($param);
    }
}
