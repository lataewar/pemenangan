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
    Schema::create('pemilus', function (Blueprint $table) {
      $table->id();
      $table->foreignId('tps_id')->constrained('tps')->cascadeOnDelete();
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
      $table->bigInteger('jml_dpt')->default(0);
      $table->bigInteger('jml_suara')->default(0);
      $table->bigInteger('jml_suara_batal')->default(0);
      $table->text('desc')->nullable();
      $table->text('foto')->nullable();
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
    Schema::dropIfExists('pemilus');
  }
};
