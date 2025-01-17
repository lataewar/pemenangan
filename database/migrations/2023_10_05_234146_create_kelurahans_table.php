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
    Schema::create('kelurahans', function (Blueprint $table) {
      $table->id();
      $table->foreignId('kecamatan_id')->constrained('kecamatans')->cascadeOnDelete();
      $table->string('name', 50);
      $table->enum('status', ['Desa', 'Kelurahan']);
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
    Schema::dropIfExists('kelurahans');
  }
};
