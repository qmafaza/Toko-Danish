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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // id primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // ID user
            $table->boolean('is_primary')->default(false); // apakah alamat utama
            $table->string('name'); // nama depan
            $table->string('address'); // alamat baris 1
            $table->string('phone')->nullable(); // nomor telepon
            $table->integer('city'); // kota (integer)
            $table->integer('province'); // provinsi (integer)
            $table->string('postcode'); // kode pos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};