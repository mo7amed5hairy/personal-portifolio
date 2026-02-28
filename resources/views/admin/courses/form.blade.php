@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ isset($course) ? 'Edit Course' : 'Add Course' }}</h1>
        <p class="mt-2 text-slate-600 dark:text-slate-400">{{ isset($course) ? 'Update course details' : 'Add a new course or certification' }}</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ isset($course) ? route('admin.courses.update', $course) : route('admin.courses.store') }}" method="POST">
            @csrf
            @if(isset($course))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">Course Title</label>
                    <input type="text" name="title" value="{{ old('title', $course->title ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Provider</label>
                    <input type="text" name="provider" value="{{ old('provider', $course->provider ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
                    @error('provider')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Completion Date</label>
                    <input type="date" name="completion_date" value="{{ old('completion_date', isset($course) && $course->completion_date ? $course->completion_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('completion_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('description', $course->description ?? '') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">Certificate Link</label>
                    <input type="url" name="certificate_link" value="{{ old('certificate_link', $course->certificate_link ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('certificate_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex items-center space-x-4">
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    {{ isset($course) ? 'Update Course' : 'Create Course' }}
                </button>
                <a href="{{ route('admin.courses.index') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
