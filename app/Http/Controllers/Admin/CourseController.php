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
        ]);

        Course::create($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully!');
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
        ]);

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Course deleted successfully!');
    }
}
