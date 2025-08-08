<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingMarketingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_marketings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->decimal('unit_price', 10, 2)->nullable();
            $table->text('distribution_channels')->nullable();
            $table->text('online_presence')->nullable();
            $table->text('seasonality')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_marketings');
    }
}