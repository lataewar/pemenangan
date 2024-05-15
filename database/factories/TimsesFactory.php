<?php

namespace Database\Factories;

use App\Models\Kelurahan;
use App\Models\Timses;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timses>
 */
class TimsesFactory extends Factory
{
  protected $model = Timses::class;

  public function definition()
  {
    $ids = Kelurahan::pluck('id');
    return [
      'name' => fake()->name(),
      'email' => fake()->unique()->safeEmail(),
      'email_verified_at' => now(),
      'password' => Hash::make('12345678'),
      'remember_token' => Str::random(10),

      'kelurahan_id' => $this->faker->randomElement($ids),
      'alamat' => $this->faker->address(),
      'no_tlp' => $this->faker->phoneNumber(),
    ];
  }
}
