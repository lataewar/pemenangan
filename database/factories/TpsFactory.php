<?php

namespace Database\Factories;

use App\Models\Kelurahan;
use App\Models\Tps;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tps>
 */
class TpsFactory extends Factory
{
  protected $model = Tps::class;
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $ids = Kelurahan::pluck('id');
    return [
      'name' => $this->faker->name(),
      'kelurahan_id' => $this->faker->randomElement($ids),
      'alamat' => $this->faker->address(),
      'desc' => $this->faker->text(50),
    ];
  }
}
