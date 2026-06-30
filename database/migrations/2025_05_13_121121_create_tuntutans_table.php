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
        Schema::create('tuntutans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ahli');
            $table->string('nama_tuntutan');
            $table->string('email');
            $table->string('phone');
            $table->decimal('jumlah_dituntut', 10, 2)->default(0);
            $table->decimal('jumlah_diluluskan', 10, 2)->nullable();
            $table->string('sijil_kematian_path');
            $table->string('status')->default('dalam proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuntutans');
    }
};
