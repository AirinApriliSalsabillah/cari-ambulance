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
        Schema::create('ambulance', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pemilik');
            $table->string('foto');
            $table->text('keterangan');
            $table->enum('status', ['Tersedia', 'Tidak Tersedia']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambulance');
    }
};
