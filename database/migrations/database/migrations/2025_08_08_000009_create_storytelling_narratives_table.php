<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorytellingNarrativesTable extends Migration
{
    public function up(): void
    {
        Schema::create('storytelling_narratives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->text('origin_story')->nullable();
            $table->text('product_backstory')->nullable();
            $table->text('brand_values')->nullable();
            $table->text('principles')->nullable();
            $table->text('eco_friendly_practices')->nullable();
            $table->text('community_impact')->nullable();
            $table->text('impact_story')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('storytelling_narratives');
    }
}