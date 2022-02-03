<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerifikasimemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasimember', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('namalengkap');
            $table->string('nomoridentitas');
            $table->string('alamatidentitas');
            $table->string('fotoidentitas');
            $table->date('tanggal_lahir');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasimember');
    }
}
