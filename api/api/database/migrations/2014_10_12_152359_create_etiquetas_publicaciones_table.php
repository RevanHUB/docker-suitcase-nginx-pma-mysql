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
        Schema::create('etiquetas_publicaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_etiqueta')->references('id')->on('etiquetas')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_publicacion')->references('id')->on('publicaciones')->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('etiquetas_publicaciones');
    }
};
