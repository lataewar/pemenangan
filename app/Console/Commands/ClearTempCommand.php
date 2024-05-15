<?php

namespace App\Console\Commands;

use App\Models\TemporaryFile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ClearTempCommand extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'temp:clear';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command description';

  /**
   * Execute the console command.
   *
   * @return int
   */
  public function handle()
  {
    $query = TemporaryFile::whereTime('created_at', '<=', Carbon::now()->subMinutes(10))->get()->each(function ($item) {
      $item->delete();
    });

    if ($query) Log::info('Scheduler clear temporary file berhasil dijalankan');

    return Command::SUCCESS;
  }
}
