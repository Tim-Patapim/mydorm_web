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
        Schema::create('paket', function (Blueprint $table) {
            $table->id('paket_id');
            $table->enum('status_pengambilan', ['sudah', 'belum'])->default('belum');
            $table->dateTime('waktu_tiba');
            $table->dateTime('waktu_diambil')->nullable();
            $table->foreignId('dormitizen_id')->nullable()->constrained('dormitizen', 'dormitizen_id')->onDelete('set null');
            $table->foreignId('penerima_paket')->nullable()->constrained('helpdesk', 'helpdesk_id')->onDelete('set null');
            $table->foreignId('penyerahan_paket')->nullable()->constrained('helpdesk', 'helpdesk_id')->onDelete('set null');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};
