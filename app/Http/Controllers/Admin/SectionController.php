<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'order' => [
                'nullable',
                'integer',
                Rule::unique('sections'),
            ],
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'title.required' => 'حقل عنوان القسم مطلوب',
            'title.string' => 'يجب أن يكون العنوان نصاً',
            'title.max' => 'يجب ألا يتجاوز العنوان 255 حرفاً',
            'content.string' => 'يجب أن يكون المحتوى نصاً',
            'order.integer' => 'يجب أن يكون الترتيب رقماً صحيحاً',
            'order.unique' => 'هذا الرقم مستخدم من قسم آخر (نشط أو غير نشط). احذف القسم غير النشط أو استخدم رقماً مختلفاً',
            'image.image' => 'يجب أن يكون الملف صورة',
            'image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, svg, webp',
            'image.max' => 'الحد الأقصى لحجم الصورة 2 ميجابايت',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        // المحتوى يُحفظ كنص عادي مباشرة بدون أي تحويل
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
            'order' => [
                'nullable',
                'integer',
                Rule::unique('sections')->ignore($section->id),
            ],
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'title.required' => 'حقل عنوان القسم مطلوب',
            'title.string' => 'يجب أن يكون العنوان نصاً',
            'title.max' => 'يجب ألا يتجاوز العنوان 255 حرفاً',
            'content.string' => 'يجب أن يكون المحتوى نصاً',
            'order.integer' => 'يجب أن يكون الترتيب رقماً صحيحاً',
            'order.unique' => 'هذا الرقم مستخدم من قسم آخر (نشط أو غير نشط). احذف القسم غير النشط أو استخدم رقماً مختلفاً',
            'image.image' => 'يجب أن يكون الملف صورة',
            'image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, svg, webp',
            'image.max' => 'الحد الأقصى لحجم الصورة 2 ميجابايت',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($section->image) {
                $section->deleteMedia($section->image);
            }
            $validated['image'] = $section->uploadMedia($request->file('image'), [
                'folder' => 'sections'
            ]);
        }

        // المحتوى يُحفظ كنص عادي مباشرة
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
