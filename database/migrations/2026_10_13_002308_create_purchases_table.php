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
    Schema::create('purchases', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Relacionamento com o Usuário
        $table->foreign('user_id')->references('id')->on('users');
        $table->unsignedBigInteger('ticket_id'); // Relacionamento com o Ingresso
        $table->foreign('ticket_id')->references('id')->on('tickets');
        $table->integer('payment_type'); 
        $table->string('payment_status')->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
