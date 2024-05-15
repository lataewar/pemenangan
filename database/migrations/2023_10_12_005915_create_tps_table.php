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
    Schema::create('tps', function (Blueprint $table) {
      $table->id();
      $table->foreignId('kelurahan_id')->constrained('kelurahans')->cascadeOnDelete();
      $table->string('name', 50);
      $table->string('alamat')->nullable();
      $table->string('desc')->nullable();
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
    Schema::dropIfExists('tps');
  }
};
