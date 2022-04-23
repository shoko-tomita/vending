<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CompaniesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<=5; $i++) {
            DB::table('companies')->insert([
                'company_name' => "test",
                'street_address' => "test111",
                'representative_name' => "aaa",
            ]);
        }
    }
}
