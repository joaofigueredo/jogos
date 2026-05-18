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
        Schema::create('favoritos', function (Blueprint $table) {

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignID('id_jogo')->references('id')->on('jogos')->onDelete('cascade');

            $table->primary(['user_id', 'id_jogo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
