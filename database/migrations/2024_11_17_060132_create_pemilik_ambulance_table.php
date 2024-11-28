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
        Schema::create('pemilik_ambulance', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('nama_instansi', '100');
            $table->text('alamat');
            $table->string('nomor_hp');
            $table->text('deskripsi');
            $table->string('latitude', '30');
            $table->string('longitude', '30');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemilik_ambulance');
    }
};
