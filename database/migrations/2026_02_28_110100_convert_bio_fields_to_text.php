<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Bio table
        Schema::table('bios', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('about_me')->change();
        });

        // Projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->text('title')->change();
            $table->longText('description')->change();
        });

        // Courses table
        Schema::table('courses', function (Blueprint $table) {
            $table->text('title')->change();
            $table->longText('description')->change();
        });

        // Sections table
        Schema::table('sections', function (Blueprint $table) {
            $table->text('title')->change();
            $table->longText('content')->change();
        });
    }

    public function down(): void
    {
        // This can't be easily reversed, so we'll leave it as is
    }
};
