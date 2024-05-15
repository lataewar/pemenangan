<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('calon_tps', function (Blueprint $table) {
      $table->foreignId('calon_id')->constrained('calons')->cascadeOnDelete();
      $table->foreignId('tps_id')->constrained('tps')->cascadeOnDelete();
      $table->bigInteger('suara')->default(0);
      $table->primary(['calon_id', 'tps_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('calon_tps');
  }
};
