<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;



return new class extends Migration
{
    public $recordTypesEnum = [
        'tooth-chart-children', 
        'tooth-chart-adult', 
        'dental-procedure-consent-form-a', 
        'dental-procedure-consent-form-b',
        'dental-certificate'
    ];

    public $statusEnum = [
        'active',
        'archived'
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('document_filepath');
            $table->enum('record_type', $this->recordTypesEnum);
            $table->enum('status', $this->statusEnum);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_records');
    }
};
