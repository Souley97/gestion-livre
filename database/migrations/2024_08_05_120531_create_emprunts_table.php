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
        Schema::create('emprunts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('livre_id');
            $table->unsignedBigInteger('user_id');
            $table->date('date_emprunt');
            $table->date('date_retour_prevue')->nullable();
            $table->date('date_retour_reelle')->nullable();

            $table->foreign('livre_id')->references('id')->on('livres')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
