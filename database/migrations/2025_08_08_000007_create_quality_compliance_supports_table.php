<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualityComplianceSupportsTable extends Migration
{
    public function up(): void
    {
        Schema::create('quality_compliance_supports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->text('certifications_licenses')->nullable();
            $table->text('quality_challenges')->nullable();
            $table->text('requested_support')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quality_compliance_supports');
    }
}