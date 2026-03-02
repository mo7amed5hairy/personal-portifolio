<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('completion_date', 'desc')->get();
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'certificate_link' => 'nullable|url',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'title.required' => 'حقل عنوان الكورس مطلوب',
            'title.string' => 'يجب أن يكون العنوان نصاً',
            'title.max' => 'يجب ألا يتجاوز العنوان 255 حرفاً',
            'provider.required' => 'حقل اسم المنصة مطلوب',
            'provider.string' => 'يجب أن يكون اسم المنصة نصاً',
            'provider.max' => 'يجب ألا يتجاوز اسم المنصة 255 حرفاً',
            'description.string' => 'يجب أن يكون الوصف نصاً',
            'completion_date.date' => 'يجب أن يكون تاريخ الإنجاز تاريخاً صحيحاً',
            'course_image.image' => 'يجب أن يكون الملف صورة',
            'course_image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, svg, webp',
            'course_image.max' => 'الحد الأقصى لحجم الصورة 5 ميجابايت',
            'certificate_link.url' => 'يرجى إدخال رابط صحيح',
        ]);

        // Handle image upload
        if ($request->hasFile('course_image')) {
            $course = new Course();
            $validated['course_image'] = $course->uploadMedia($request->file('course_image'), [
                'folder' => 'courses'
            ]);
        }

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'تم إضافة الكورس بنجاح!');
    }

    public function edit(Course $course)
    {
        return view('admin.courses.form', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'provider' => 'required|string|max:255',
            'description' => 'nullable|string',
            'completion_date' => 'nullable|date',
            'certificate_link' => 'nullable|url',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'title.required' => 'حقل عنوان الكورس مطلوب',
            'title.string' => 'يجب أن يكون العنوان نصاً',
            'title.max' => 'يجب ألا يتجاوز العنوان 255 حرفاً',
            'provider.required' => 'حقل اسم المنصة مطلوب',
            'provider.string' => 'يجب أن يكون اسم المنصة نصاً',
            'provider.max' => 'يجب ألا يتجاوز اسم المنصة 255 حرفاً',
            'description.string' => 'يجب أن يكون الوصف نصاً',
            'completion_date.date' => 'يجب أن يكون تاريخ الإنجاز تاريخاً صحيحاً',
            'course_image.image' => 'يجب أن يكون الملف صورة',
            'course_image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, svg, webp',
            'course_image.max' => 'الحد الأقصى لحجم الصورة 5 ميجابايت',
            'certificate_link.url' => 'يرجى إدخال رابط صحيح',
        ]);

        // Handle image upload
        if ($request->hasFile('course_image')) {
            if ($course->course_image) {
                $course->deleteMedia($course->course_image);
            }
            $validated['course_image'] = $course->uploadMedia($request->file('course_image'), [
                'folder' => 'courses'
            ]);
        }

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث الكورس بنجاح!');
    }

    public function destroy(Course $course)
    {
        if ($course->course_image) {
            $course->deleteMedia($course->course_image);
        }
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'تم حذف الكورس بنجاح!');
    }
}
