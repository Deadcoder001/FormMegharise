<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('district_id')->constrained();
            $table->foreignId('enumerator_id')->nullable()->constrained('users');
            $table->string('vendor_name');
            $table->string('enterprise_name');
            $table->string('contact_person');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('business_address');
            $table->string('registered_address')->nullable();
            $table->integer('years_in_business')->nullable();
            $table->string('gst_no')->nullable();
            $table->text('certifications')->nullable();
            $table->string('google_drive_folder_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
}