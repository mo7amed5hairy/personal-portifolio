<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * تحويل عمود content من JSON إلى نص عادي
     */
    public function up(): void
    {
        // تغيير نوع العمود title من text إلى string
        Schema::table('sections', function (Blueprint $table) {
            $table->string('title', 255)->change();
            $table->text('content')->nullable()->change();
        });

        // تحويل البيانات الموجودة من JSON إلى نص عادي
        $sections = DB::table('sections')->get();
        foreach ($sections as $section) {
            $content = $section->content;
            $title = $section->title;

            // محاولة فك JSON القديم واستخراج النص
            $decoded = json_decode($content, true);
            if (is_array($decoded)) {
                // استخراج النص من الـ JSON القديم
                $plainText = '';

                // محاولة استخراج من ar أولاً
                if (isset($decoded['ar'])) {
                    $arData = $decoded['ar'];
                    if (is_array($arData)) {
                        $parts = [];
                        if (isset($arData['headline'])) $parts[] = $arData['headline'];
                        if (isset($arData['subheadline'])) $parts[] = $arData['subheadline'];
                        if (isset($arData['description'])) $parts[] = $arData['description'];
                        $plainText = implode("\n", $parts);
                    } elseif (is_string($arData)) {
                        $plainText = $arData;
                    }
                } elseif (isset($decoded['headline'])) {
                    $parts = [];
                    if (isset($decoded['headline'])) $parts[] = $decoded['headline'];
                    if (isset($decoded['description'])) $parts[] = $decoded['description'];
                    $plainText = implode("\n", $parts);
                }

                if (empty($plainText)) {
                    $plainText = $content; // إبقاء المحتوى كما هو إذا لم يتم استخراج شيء
                }

                DB::table('sections')
                    ->where('id', $section->id)
                    ->update(['content' => $plainText]);
            }

            // تحويل العنوان من JSON إلى نص عادي
            $decodedTitle = json_decode($title, true);
            if (is_array($decodedTitle)) {
                $plainTitle = $decodedTitle['ar'] ?? $decodedTitle['en'] ?? $title;
                DB::table('sections')
                    ->where('id', $section->id)
                    ->update(['title' => $plainTitle]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // لا يمكن التراجع عن تحويل البيانات
    }
};
