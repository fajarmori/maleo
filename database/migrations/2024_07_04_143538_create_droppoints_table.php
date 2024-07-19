<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('droppoints', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('address');
            $table->text('notes')->nullable();
            $table->foreignId('department_id')->nullable();
            $table->foreignId('site_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('droppoints');
    }
};