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
    Schema::table('users', function (Blueprint $table) {
      $table->foreignId('role_id')->nullable()->change();
      $table->foreignId('kelurahan_id')->nullable()->after('role_id');

      $table->after('name', function (Blueprint $table) {
        $table->string('no_tlp', 50)->nullable();
        $table->string('alamat')->nullable();
      });
    });

    Schema::dropIfExists('timses');
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('users', function (Blueprint $table) {
      $table->foreignId('role_id')->change();
      $table->dropColumn(['kelurahan_id', 'no_tlp', 'alamat']);
    });
  }
};
