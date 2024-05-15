<?php

namespace App\Console\Commands;

use Database\Seeders\PemiluSeeder;
use Illuminate\Console\Command;

class SeedPemiluCommand extends Command
{
  protected $signature = 'seed:pemilu {limit}';

  protected $description = 'Seed Pemilu Data';

  public function handle(PemiluSeeder $seeder)
  {
    $limit = $this->argument('limit');
    $seeder->run($limit);
    return Command::SUCCESS;
  }
}
