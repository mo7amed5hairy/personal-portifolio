<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bio;
use Illuminate\Http\Request;

class BioController extends Controller
{
    public function edit()
    {
        $bio = Bio::first() ?? new Bio();
        return view('admin.bio.form', compact('bio'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'about_me' => 'required|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
        ], [
            'full_name.required' => 'حقل الاسم الكامل مطلوب',
            'title.required' => 'حقل المسمى الوظيفي مطلوب',
            'about_me.required' => 'حقل نبذة عنك مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'profile_image.image' => 'يجب أن يكون الملف صورة',
            'profile_image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, webp',
            'cv_file.mimes' => 'الصيغ المسموحة: pdf, doc, docx',
        ]);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $bio = Bio::first();
            if ($bio && $bio->profile_image) {
                $bio->deleteMedia($bio->profile_image);
            }
            $bioForUpload = $bio ?? new Bio();
            $validated['profile_image'] = $bioForUpload->uploadMedia($request->file('profile_image'), [
                'folder' => 'bio'
            ]);
        }

        // Handle CV upload
        if ($request->hasFile('cv_file')) {
            $bio = Bio::first();
            if ($bio && $bio->cv_path) {
                $bio->deleteMedia($bio->cv_path);
            }
            $bioForUpload = $bio ?? new Bio();
            $validated['cv_path'] = $bioForUpload->uploadMedia($request->file('cv_file'), [
                'folder' => 'bio'
            ]);
        }

        // Store Arabic only (not as array)
        $bio = Bio::first();
        $data = [
            'full_name' => $validated['full_name'],
            'title' => $validated['title'],
            'about_me' => $validated['about_me'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
        ];

        // Add profile image if uploaded
        if (isset($validated['profile_image'])) {
            $data['profile_image'] = $validated['profile_image'];
        }

        // Add CV if uploaded
        if (isset($validated['cv_path'])) {
            $data['cv_path'] = $validated['cv_path'];
        }

        if ($bio) {
            $bio->update($data);
            $bio->refresh();
        } else {
            $bio = Bio::create($data);
        }

        return redirect()->route('admin.bio.edit')->with('success', 'تم حفظ البيانات بنجاح!');
    }
}
