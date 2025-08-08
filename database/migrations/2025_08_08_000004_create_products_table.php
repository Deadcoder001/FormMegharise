<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('category', ['food', 'handicraft', 'other'])->default('food');
            $table->string('shelf_life')->nullable();
            $table->string('production_capacity')->nullable();
            $table->text('current_markets')->nullable(); // JSON or comma separated
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}