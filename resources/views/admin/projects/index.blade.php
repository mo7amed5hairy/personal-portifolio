@extends('layouts.admin')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Projects</h1>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Project
        </a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-slate-50 dark:bg-slate-700/50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Title</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Featured</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold">Order</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                @forelse($projects as $project)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($project->image)
                                    <img src="{{ $project->image }}" alt="" class="w-12 h-12 rounded-lg object-cover mr-4">
                                @endif
                                <div>
                                    <p class="font-medium">{{ $project->title }}</p>
                                    <p class="text-sm text-slate-500">{{ Str::limit($project->description, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($project->is_featured)
                                <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 text-xs rounded-full">Yes</span>
                            @else
                                <span class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 text-xs rounded-full">No</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $project->order }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                            No projects yet. <a href="{{ route('admin.projects.create') }}" class="text-primary-600 hover:underline">Create one</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
