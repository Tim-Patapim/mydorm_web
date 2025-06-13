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
        Schema::create('laporan', function (Blueprint $table) {
            $table->id('laporan_id');
            $table->string('judul', 100);
            $table->text('isi');
            $table->foreignId('dormitizen_id')->nullable()->constrained('dormitizen', 'dormitizen_id')->onDelete('set null');
            $table->foreignId('helpdesk_id')->nullable()->constrained('helpdesk', 'helpdesk_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
