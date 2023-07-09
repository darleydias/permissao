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
        Schema::create('permissao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('funcionalidade_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('funcionalidade_id')->references('id')->on('funcionalidade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissao');
    }
};
