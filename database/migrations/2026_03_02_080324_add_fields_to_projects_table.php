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
        Schema::table('projects', function (Blueprint $table) {
            $table->date('project_date')->nullable()->after('description');
            $table->string('client_name')->nullable()->after('project_date');
            $table->string('project_location')->nullable()->after('client_name');
            $table->string('project_url')->nullable()->after('project_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['project_date', 'client_name', 'project_location', 'project_url']);
        });
    }
};
