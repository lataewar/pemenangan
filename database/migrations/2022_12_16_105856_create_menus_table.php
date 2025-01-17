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
    Schema::create('menus', function (Blueprint $table) {
      $table->id();
      $table->string('name', 64);
      $table->string('route', 128)->nullable();
      $table->string('icon', 128)->nullable();
      $table->text('desc')->nullable();
      $table->boolean('has_submenu')->default(false);
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
    Schema::dropIfExists('menus');
  }
};
