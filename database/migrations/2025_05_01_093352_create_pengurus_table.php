<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengurus', function (Blueprint $table) {
            $table->id(); // kolom No (ID otomatis)
            $table->string('foto')->nullable(); // menyimpan path foto
            $table->string('nama');
            $table->string('email')->unique();
            $table->text('alamat');
            $table->string('nomor_telepon');
            $table->string('divisi');
            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); // untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengurus');
    }
}
