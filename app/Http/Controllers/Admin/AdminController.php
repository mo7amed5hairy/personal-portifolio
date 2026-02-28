<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Section;
use App\Models\Course;

class AdminController extends Controller
{
    public function index()
    {
        $projectsCount = Project::count();
        $sectionsCount = Section::where('is_active', true)->count();
        $coursesCount = Course::count();
        $featuredCount = Project::where('is_featured', true)->count();

        return view('admin.dashboard', compact('projectsCount', 'sectionsCount', 'coursesCount', 'featuredCount'));
    }
}
