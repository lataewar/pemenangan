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
    Schema::table('calons', function (Blueprint $table) {
      $table->boolean('is_selected')->nullable()->unique()->change();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('calons', function (Blueprint $table) {
      $table->boolean('is_selected')->default(false)->change();
    });
  }
};
