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
        Schema::create('mutasi', function (Blueprint $table) {
            $table->bigIncrements('id_mutasi');
            $table->string('asal_cabang_id', 100);
            $table->string('tujuan_cabang_id', 100);
            $table->string('approved_by', 50);
            $table->string('notes', 100)->nullable();
            $table->unsignedInteger('jumlah');
            $table->string('barcode', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasis');
    }
};

