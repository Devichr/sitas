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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Kaprodi yang akan menerima notifikasi
            $table->string('type'); // Jenis notifikasi, bisa 'proposal' atau 'skripsi'
            $table->unsignedBigInteger('reference_id'); // ID referensi dari proposal atau skripsi
            $table->string('message'); // Pesan notifikasi
            $table->boolean('is_read')->default(false); // Status notifikasi, apakah sudah dibaca atau belum
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
