<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ProjectService;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct(
        protected ProjectService $projectService
    ) {}

    public function index()
    {
        $projects = $this->projectService->getAllProjects();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        
        // Convert tags string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $this->projectService->createProject(new \App\DTOs\ProjectDTO(...$validated));

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        $this->projectService->updateProject($project->id, new \App\DTOs\ProjectDTO(...$validated));

        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully!');
    }

    public function destroy(Project $project)
    {
        $this->projectService->deleteProject($project->id);
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully!');
    }
}
