<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('district')->nullable()->after('role');
            $table->string('gm_id')->nullable()->unique()->after('district');
            $table->string('status')->default('pending')->after('gm_id'); // For approval
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['district', 'gm_id', 'status']);
        });
    }
};