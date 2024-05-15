<?php

namespace Database\Factories;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kecamatan>
 */
class KecamatanFactory extends Factory
{
  protected $model = Kecamatan::class;
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $ids = Kabupaten::pluck('id');
    return [
      'name' => $this->faker->name(),
      'kabupaten_id' => $this->faker->randomElement($ids),
    ];
  }
}
