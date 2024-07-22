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
        Schema::create('offered_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('name_slug')->unique();
            $table->text('description');
            $table->float('price', 8, 2);
            $table->enum('status', ['draft', 'published']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offered_services');
    }
};
