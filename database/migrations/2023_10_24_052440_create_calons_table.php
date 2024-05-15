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
    Schema::create('calons', function (Blueprint $table) {
      $table->id();
      $table->string('name', 100);
      $table->smallInteger('no_urut');
      $table->boolean('is_selected')->default(false);
      $table->text('desc')->nullable();
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
    Schema::dropIfExists('calons');
  }
};
