<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Penjualan;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(100)->make();
    }
}
