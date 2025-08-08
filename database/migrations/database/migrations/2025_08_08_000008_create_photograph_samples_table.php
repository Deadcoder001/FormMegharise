<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotographSamplesTable extends Migration
{
    public function up(): void
    {
        Schema::create('photograph_samples', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->text('product_photos')->nullable(); // JSON or comma separated
            $table->text('packaging_photos')->nullable();
            $table->text('sampling_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('photograph_samples');
    }
}