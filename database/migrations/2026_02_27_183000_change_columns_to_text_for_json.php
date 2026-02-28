<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change title columns to TEXT for JSON storage
        Schema::table('projects', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('description')->change();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('description')->change();
        });

        Schema::table('bios', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('about_me')->change();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->text('title')->change();
            $table->text('content')->change();
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->change();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->change();
        });

        Schema::table('bios', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('about_me')->change();
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('content')->change();
        });
    }
};
