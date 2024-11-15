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
        Schema::create('user_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Relasi dengan pengguna
            $table->string('activity'); // Jenis aktivitas (misal: 'created', 'updated', 'deleted')
            $table->string('target_type'); // Tipe model yang terpengaruh (misal: 'product', 'order', dll.)
            $table->unsignedBigInteger('target_id'); // ID dari objek yang terpengaruh
            $table->text('description')->nullable(); // Deskripsi aktivitas (misal: nama produk yang dibuat atau diubah)
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
