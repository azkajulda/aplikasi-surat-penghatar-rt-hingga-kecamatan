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
        Schema::create('list_ketua_rts', function (Blueprint $table) {
            $table->unsignedBigInteger('id_rt');
            $table->foreign('id_rt')->references('id')->on('rts')->onDelete('cascade');
            $table->unsignedBigInteger('id_profile');
            $table->foreign('id_profile')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_ketua_rts');
    }
};
