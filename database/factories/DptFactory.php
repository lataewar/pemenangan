<?php

namespace Database\Factories;

use App\Models\Dpt;
use App\Models\Tps;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dpt>
 */
class DptFactory extends Factory
{
  protected $model = Dpt::class;
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $ids = Tps::select(['id', 'kelurahan_id'])->get();
    $fake = $this->faker->randomElement($ids);
    return [
      'name' => $this->faker->name(),
      'nik' => $this->faker->nik(),
      'no_tlp' => $this->faker->phoneNumber(),
      'tps_id' => $fake->id,
      'kelurahan_id' => $fake->kelurahan_id,
      'timses_id' => 1,
      'alamat' => $this->faker->address(),
      'desc' => $this->faker->text(50),
    ];
  }
}
