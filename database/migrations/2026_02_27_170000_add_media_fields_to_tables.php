<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add media fields to projects table
        Schema::table('projects', function (Blueprint $table) {
            $table->json('gallery')->nullable()->after('image');
            $table->string('video')->nullable()->after('gallery');
        });

        // Add media fields to courses table
        Schema::table('courses', function (Blueprint $table) {
            $table->string('certificate_image')->nullable()->after('certificate_link');
            $table->string('course_image')->nullable()->after('certificate_image');
            $table->integer('order')->default(0)->after('course_image');
        });

        // Add media fields to bios table
        Schema::table('bios', function (Blueprint $table) {
            $table->string('profile_image')->nullable()->after('social_links');
            $table->string('hero_video')->nullable()->after('profile_image');
            $table->json('skills')->nullable()->after('hero_video');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['gallery', 'video']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn(['certificate_image', 'course_image', 'order']);
        });

        Schema::table('bios', function (Blueprint $table) {
            $table->dropColumn(['profile_image', 'hero_video', 'skills']);
        });
    }
};
