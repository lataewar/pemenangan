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
    Schema::create('kabupatens', function (Blueprint $table) {
      $table->id();
      $table->string('name', 50);
      $table->enum('status', ['Kabupaten', 'Kota']);
      $table->bigInteger('jumlah_dpt')->nullable();
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
    Schema::dropIfExists('kabupatens');
  }
};
