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
        Schema::create('danas', function (Blueprint $table) {
            $table->id();
            $table->decimal('jumlah', 10, 2);
            $table->string('kaedah_bayaran'); // QR, FPX, Debit
            $table->string('resit_path');
            $table->string('nama_ahli'); // New field for member name
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danas');
    }
};
