<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('mria')->unique();
            $table->string('nik')->unique();
            $table->string('born');
            $table->string('birthday');
            $table->string('phone');
            $table->text('address');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('detail_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('occupation_id')->nullable();
            $table->string('email')->nullable();
            $table->date('resign')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('detail_employees');
    }
};
