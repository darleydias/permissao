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
        Schema::create('grupo_usuario', function (Blueprint $table) {
            $table->increments('id');
            $table->biginteger('user_id')->default(20)->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->timestamps();

            $table->foreign('grupo_id')->references('id')->on('grupo');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grupo_usuario');
    }
};
