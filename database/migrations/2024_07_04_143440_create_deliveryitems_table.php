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
        Schema::create('deliveryitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deliverynote_id');
            $table->string('code');
            $table->string('name');
            $table->string('quantity');
            $table->string('unit');
            $table->string('bale');
            $table->string('price');
            $table->text('notes');
            $table->string('purchase_order')->nullable();
            $table->string('date_request')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveryitems');
    }
};
