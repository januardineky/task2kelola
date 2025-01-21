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
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_number');
            $table->text('address');
            $table->enum('major',['Rekayasa Perangkat Lunak','Teknik Komputer Jaringan','Teknik Elektronika Industri','Desain Komunikasi Visual','Desain Pemodelan dan Informasi Bangunan','Teknik Sepeda Motor','Teknik Kendaraan Ringan']);
            $table->tinyinteger('status');
            $table->string('password');
            $table->enum('rolename',['User','Admin']);
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
