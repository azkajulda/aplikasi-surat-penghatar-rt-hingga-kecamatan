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
        Schema::create('list_keluargas', function (Blueprint $table) {
            $table->id();
            $table->string('status_keluarga')->nullable();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_rt');
            $table->foreign('id_rt')->references('id')->on('rts')->onDelete('cascade');
            $table->unsignedBigInteger('id_rw');
            $table->foreign('id_rw')->references('id')->on('rws')->onDelete('cascade');
            $table->unsignedBigInteger('id_profile');
            $table->foreign('id_profile')->references('id')->on('profiles')->onDelete('cascade');
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
        Schema::dropIfExists('list_keluargas');
    }
};
