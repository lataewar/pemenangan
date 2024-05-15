<?php

namespace Database\Seeders;

use App\Models\Calon;
use App\Models\Pemilu;
use App\Models\Tps;
use Faker\Generator;
use Illuminate\Database\Seeder;

class PemiluSeeder extends Seeder
{
  // Use this command to run : php artisan seed:pemilu {limit}
  // ex : php artisan seed:pemilu 1

  public function run(int $limit)
  {
    $faker = app(Generator::class);

    $tps_exc = Pemilu::get()->pluck('tps_id');
    $num_tps = Tps::select('id')->whereNotIn('id', $tps_exc)->limit($limit)->get()->each(function ($item) use ($faker) {

      // create pemilu factory with replaced tps_id
      $pemilu = Pemilu::factory()->state(['tps_id' => $item->id])->create();

      // get max number for suara
      $max = $pemilu->jml_suara / Calon::count();

      $suaras = Calon::select('id')->get()->mapWithKeys(function ($item, $key) use ($faker, $max) {
        return [$item->id => ['suara' => $faker->numberBetween(0, $max)]];
      });

      $pemilu->calons()->sync($suaras);
    })->count();

    echo "Successfully Seeded " . $num_tps . " data \n";
  }
}
