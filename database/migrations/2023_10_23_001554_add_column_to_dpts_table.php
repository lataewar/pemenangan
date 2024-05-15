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
    Schema::table('dpts', function (Blueprint $table) {
      $table->after('name', function (Blueprint $table) {
        $table->string('nik', 50);
        $table->string('no_tlp', 50)->nullable();
        $table->foreignId('timses_id');
      });
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('dpts', function (Blueprint $table) {
      $table->dropColumn(['nik', 'no_tlp', 'timses_id']);
    });
  }
};
