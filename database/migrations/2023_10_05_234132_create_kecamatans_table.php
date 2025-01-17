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
    Schema::create('kecamatans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('kabupaten_id')->constrained('kabupatens')->cascadeOnDelete();
      $table->string('name', 50);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('kecamatans');
  }
};
