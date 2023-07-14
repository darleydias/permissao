<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('funcionalidade', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 100);
            $table->string('URL', 100);
            $table->integer('sistema_id')->unsigned();
            $table->timestamps();

            $table->foreign('sistema_id')->references('id')->on('sistema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionalidade');
    }
};
