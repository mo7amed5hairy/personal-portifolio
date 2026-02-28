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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|string',
        ], [
            'title.required' => 'حقل عنوان المشروع مطلوب',
            'description.required' => 'حقل وصف المشروع مطلوب',
            'image.image' => 'يجب أن يكون الملف صورة',
            'image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, svg, webp',
            'link.url' => 'يرجى إدخال رابط صحيح',
            'github_link.url' => 'يرجى إدخال رابط صحيح',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $project = new Project();
            $validated['image'] = $project->uploadMedia($request->file('image'), [
                'folder' => 'projects'
            ]);
        }
        
        // Convert tags string to array
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        // Create slug from title
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

        // Pass to DTO (DTO expects strings)
        $this->projectService->createProject(new \App\DTOs\ProjectDTO(
            title: $validated['title'],
            slug: $validated['slug'],
            description: $validated['description'],
            image: $validated['image'] ?? null,
            link: $validated['link'] ?? null,
            github_link: $validated['github_link'] ?? null,
            tags: $validated['tags'],
            order: $validated['order'] ?? 0,
            is_featured: $validated['is_featured'] ?? false,
        ));

        return redirect()->route('admin.projects.index')->with('success', 'تم إضافة المشروع بنجاح!');
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'link' => 'nullable|url',
            'github_link' => 'nullable|url',
            'order' => 'nullable|integer',
            'is_featured' => 'nullable|boolean',
            'tags' => 'nullable|string',
        ], [
            'title.required' => 'حقل عنوان المشروع مطلوب',
            'description.required' => 'حقل وصف المشروع مطلوب',
            'image.image' => 'يجب أن يكون الملف صورة',
            'image.mimes' => 'الصيغ المسموحة: jpeg, png, jpg, gif, svg, webp',
            'link.url' => 'يرجى إدخال رابط صحيح',
            'github_link.url' => 'يرجى إدخال رابط صحيح',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        $validated['is_featured'] = $request->boolean('is_featured');
        
        // Handle image upload
        if ($request->hasFile('image')) {
            if ($project->image) {
                $project->deleteMedia($project->image);
            }
            $validated['image'] = $project->uploadMedia($request->file('image'), [
                'folder' => 'projects'
            ]);
        }
        
        if (!empty($validated['tags'])) {
            $validated['tags'] = array_map('trim', explode(',', $validated['tags']));
        } else {
            $validated['tags'] = [];
        }

        // Pass to DTO (DTO expects strings)
        $this->projectService->updateProject($project->id, new \App\DTOs\ProjectDTO(
            title: $validated['title'],
            slug: \Illuminate\Support\Str::slug($validated['title']),
            description: $validated['description'],
            image: $validated['image'] ?? null,
            link: $validated['link'] ?? null,
            github_link: $validated['github_link'] ?? null,
            tags: $validated['tags'],
            order: $validated['order'] ?? 0,
            is_featured: $validated['is_featured'] ?? false,
        ));

        return redirect()->route('admin.projects.index')->with('success', 'تم تحديث المشروع بنجاح!');
    }

    public function destroy(Project $project)
    {
        if ($project->image) {
            $project->deleteMedia($project->image);
        }
        $this->projectService->deleteProject($project->id);
        return redirect()->route('admin.projects.index')->with('success', 'تم حذف المشروع بنجاح!');
    }
}
