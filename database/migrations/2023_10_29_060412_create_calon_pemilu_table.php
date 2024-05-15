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
    Schema::create('calon_pemilu', function (Blueprint $table) {
      $table->foreignId('calon_id')->constrained('calons')->cascadeOnDelete();
      $table->foreignId('pemilu_id')->constrained('pemilus')->cascadeOnDelete();
      $table->bigInteger('suara')->default(0);
      $table->timestamps();
      $table->primary(['calon_id', 'pemilu_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('calon_pemilu');
  }
};
