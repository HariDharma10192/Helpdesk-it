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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('department_name');
            $table->string('department_destination');
            $table->string('no_workorder');
            $table->date('complaint_date');
            $table->date('solved_date')->nullable();
            $table->enum('complaint_type', ['ringan', 'sedang', 'berat']);
            $table->text('description');
            $table->string('photo')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
