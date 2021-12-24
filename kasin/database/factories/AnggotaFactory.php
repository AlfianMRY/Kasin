<?php

namespace Database\Factories;

use App\Models\Anggota;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnggotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Anggota::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Pria', 'Wanita']);
        $status = $this->faker->randomElement(['Aktif', 'Tidak Aktif']);
        return [
            'nama' => $this->faker->name(),
            'jk' => $gender,
            'no_hp' => $this->faker->phoneNumber(),
            'status' => $status,
            'user_id' => $this->faker->numberBetween(1,2), //

        ];
    }
}
