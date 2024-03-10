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
        Schema::create('publican', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_usuario')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_publicacion')->references('id')->on('users')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('publican');
    }
};
