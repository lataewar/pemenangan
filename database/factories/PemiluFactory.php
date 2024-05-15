<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pemilu>
 */
class PemiluFactory extends Factory
{


  public function definition()
  {
    return [
      'user_id' => 1,
      'tps_id' => 1,
      'jml_dpt' => $this->faker->numberBetween(5000, 10000),
      'jml_suara' => $this->faker->numberBetween(3000, 8000),
      'jml_suara_batal' => $this->faker->numberBetween(0, 100),
      'desc' => $this->faker->text(50),
    ];
  }
}
