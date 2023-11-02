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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('sapaan', ['Pak', 'Bu', 'Mas', 'Mbak', 'Kak', 'Dek'])->nullable();
            $table->string('panggilan')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telp')->unique();
            $table->string('foto_profile')->nullable();
            //sa = 0, a = 1, u = 2
            $table->enum('role',['0','1','2','3'])->nullable();
            //0 = off, 1 = on
            $table->enum('status',['0','1'])->nullable();
            //0 = laki-laki , 1 = perempuan
            $table->enum('gender',['0','1'])->nullable();
            //0 = Tidak Berlangganan , 1 = Berlangganan
            $table->enum('expired_status', ['0', '1'])->default('0');
            $table->timestamp('activated_date')->nullable();
            $table->timestamp('expired_date')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
