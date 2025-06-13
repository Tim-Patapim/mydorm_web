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
        Schema::create('pelanggaran', function (Blueprint $table) {
            $table->id('pelanggaran_id');
            $table->string('kategori', 100);
            $table->dateTime('waktu');
            $table->string('gambar', 255)->nullable();
            $table->foreignId('senior_resident_id')->nullable()->constrained('senior_resident', 'senior_resident_id')->onDelete('set null');
            $table->foreignId('dormitizen_id')->nullable()->constrained('dormitizen', 'dormitizen_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggaran');
    }
};
