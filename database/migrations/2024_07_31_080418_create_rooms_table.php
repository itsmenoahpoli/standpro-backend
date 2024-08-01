<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $roomTypes = [
        'superior-double',
        'superior-twin',
        'superior-deluxe',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->enum('type', $this->roomTypes);
            $table->string('name')->unique();
            $table->string('name_slug')->unique();
            $table->text('description')->nullable();
            $table->float('price', 8, 2);
            $table->float('promo_price', 8, 2)->nullable();
            $table->bigInteger('quantity');
            $table->boolean('is_promo')->default(false);
            $table->boolean('is_available')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
