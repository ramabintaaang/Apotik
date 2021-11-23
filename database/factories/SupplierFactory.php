<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->companyPrefix . '.' . $this->faker->lastName,
            'telp' => '08' . mt_rand(10000000000, 90000000000),
            'email' => $this->faker->unique()->safeEmail(),
            'rekening' => mt_rand(100000000000000, 9000000000000000),
            'alamat' => $this->faker->streetAddress . '-' . $this->faker->city . '-' . $this->faker->postcode
                . '-' . $this->faker->stateAbbr,
        ];
    }
}
