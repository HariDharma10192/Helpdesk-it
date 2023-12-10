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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('departement_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('role_id')->default(1); // Gantilah nilai default sesuai dengan role yang diinginkan
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
