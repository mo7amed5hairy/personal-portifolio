<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('order')->get();
        return view('admin.sections.index', compact('sections'));
    }

    public function create()
    {
        return view('admin.sections.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);

        $section = new Section();
        if ($request->hasFile('image')) {
            $validated['image'] = $section->uploadMedia($request->file('image'), [
                'folder' => 'sections'
            ]);
        }

        Section::create($validated);

        return redirect()->route('admin.sections.index')->with('success', 'تم إضافة القسم بنجاح!');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.form', compact('section'));
    }

    public function update(Request $request, Section $section)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($section->image) {
                $section->deleteMedia($section->image);
            }
            $validated['image'] = $section->uploadMedia($request->file('image'), [
                'folder' => 'sections'
            ]);
        }

        $section->update($validated);

        return redirect()->route('admin.sections.index')->with('success', 'تم تحديث القسم بنجاح!');
    }

    public function destroy(Section $section)
    {
        if ($section->image) {
            $section->deleteMedia($section->image);
        }
        $section->delete();
        return redirect()->route('admin.sections.index')->with('success', 'تم حذف القسم بنجاح!');
    }
}
