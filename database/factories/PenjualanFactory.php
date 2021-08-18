<?php

namespace Database\Factories;

use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $Penjualan = Penjualan::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_penjualan' => $this->faker->userName(),
            'id_po' => $this->faker->userName(),
            'id_gudang' => $this->faker->userName(),
            'harga_jual' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
            'tgl_jual' => $this->faker->date(),
            'nama_sales' => $this->faker->name(),
            'qty' => $this->faker->randomDigit(),
            'customer' => $this->faker->unique()->name(),
            
        ];
    }
}
