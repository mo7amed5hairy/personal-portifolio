<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bios', function (Blueprint $table) {
            $table->integer('years_experience')->nullable()->after('hero_video');
            $table->integer('projects_completed')->nullable()->after('years_experience');
            $table->integer('happy_clients')->nullable()->after('projects_completed');
            $table->integer('awards_won')->nullable()->after('happy_clients');
        });
    }

    public function down(): void
    {
        Schema::table('bios', function (Blueprint $table) {
            $table->dropColumn(['years_experience', 'projects_completed', 'happy_clients', 'awards_won']);
        });
    }
};
