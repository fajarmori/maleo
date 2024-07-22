<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deliverynotes', function (Blueprint $table) {
            $table->id();
            $table->string('letter');
            $table->date('date');
            $table->foreignId('sender_id');
            $table->string('name_sender');
            $table->string('phone_sender');
            $table->foreignId('recipient_id');
            $table->string('name_recipient');
            $table->string('phone_recipient');
            $table->date('date_recipient')->nullable();
            $table->string('via');
            $table->string('estimated_delivery')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deliverynotes');
    }
};
