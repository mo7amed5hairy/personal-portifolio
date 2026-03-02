<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\Course;
use App\Models\Project;
use App\Models\Section;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index(Request $request, $locale = 'ar')
    {
        app()->setLocale($locale);

        $bio = Bio::first();
        $sections = Section::where('is_active', true)->orderBy('order')->get();
        $featuredProjects = Project::where('is_featured', true)->orderBy('order')->limit(6)->get();
        $courses = Course::orderBy('order')->limit(6)->get();

        return view('welcome', compact('bio', 'sections', 'featuredProjects', 'courses', 'locale'));
    }

    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ], [
            'name.required' => 'حقل الاسم مطلوب',
            'email.required' => 'حقل البريد الإلكتروني مطلوب',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'subject.required' => 'حقل الموضوع مطلوب',
            'message.required' => 'حقل الرسالة مطلوب',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'شكراً لك! تم إرسال رسالتك بنجاح.');
    }
}
