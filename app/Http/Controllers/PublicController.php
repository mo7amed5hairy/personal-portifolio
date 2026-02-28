<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use App\Models\Course;
use App\Models\Project;
use App\Models\Section;
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
}
