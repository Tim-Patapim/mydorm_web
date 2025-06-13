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
        Schema::create('log_keluar_masuk', function (Blueprint $table) {
            $table->id('log_keluar_masuk_id');
            $table->dateTime('waktu');
            $table->enum('aktivitas', ['keluar', 'masuk']);
            $table->enum('status', ['diterima', 'ditolak', 'pending']);
            $table->foreignId('dormitizen_id')->nullable()->constrained('dormitizen', 'dormitizen_id')->onDelete('set null');
            $table->foreignId('senior_resident_id')->nullable()->constrained('senior_resident', 'senior_resident_id')->onDelete('set null');
            $table->foreignId('helpdesk_id')->nullable()->constrained('helpdesk', 'helpdesk_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_keluar_masuk');
    }
};
