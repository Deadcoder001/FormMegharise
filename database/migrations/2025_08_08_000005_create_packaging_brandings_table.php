<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagingBrandingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('packaging_brandings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->text('package_variations')->nullable();
            $table->text('packaging_type_materials')->nullable();
            $table->text('labeling_details')->nullable();
            $table->text('existing_branding')->nullable();
            $table->text('eco_friendly_practices')->nullable();
            $table->text('packaging_challenges')->nullable();
            $table->text('preferred_changes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packaging_brandings');
    }
}