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
        Schema::create('dormitizen', function (Blueprint $table) {
            $table->id('dormitizen_id');
            $table->string('nim', 15);
            $table->string('nama', 100);
            $table->string('prodi', 50);
            $table->string('agama', 20);
            $table->string('no_hp', 25);
            $table->string('no_hp_ortu', 25);
            $table->string('alamat_ortu', 100);
            $table->string('gambar', 255);
            $table->foreignId('kamar_id')->nullable()->constrained('kamar', 'kamar_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitizen');
    }
};
