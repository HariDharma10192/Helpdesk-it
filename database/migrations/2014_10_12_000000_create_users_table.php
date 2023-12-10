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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('role_id')->default(2); // Tambahkan kolom role_id
            $table->rememberToken();
            $table->timestamps();

            // Tambahkan foreign key constraint
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus foreign key constraint terlebih dahulu agar tidak ada error saat rollback
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::dropIfExists('roles');
        Schema::dropIfExists('users');
    }
};
