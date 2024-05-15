<?php

namespace Database\Factories;

use App\Models\Calon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calon>
 */
class CalonFactory extends Factory
{
  private static $no_urut = 1;
  protected $model = Calon::class;

  public function definition()
  {
    return [
      'name' => $this->faker->name(),
      'no_urut' => self::$no_urut++,
      'desc' => $this->faker->text(50),
    ];
  }
}
