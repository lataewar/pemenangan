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
    Schema::create('menu_role', function (Blueprint $table) {
      $table->foreignId('menu_id')->constrained('menus');
      $table->foreignId('role_id')->constrained('roles');
      $table->primary(['menu_id', 'role_id']);
    });
  }
  
  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('menu_role');
  }
};
