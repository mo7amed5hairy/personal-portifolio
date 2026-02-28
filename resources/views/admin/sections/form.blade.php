@extends('layouts.admin')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold">{{ isset($section) ? 'Edit Section' : 'Add Section' }}</h1>
        <p class="mt-2 text-slate-600 dark:text-slate-400">{{ isset($section) ? 'Update section details' : 'Create a new portfolio section' }}</p>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ isset($section) ? route('admin.sections.update', $section) : route('admin.sections.store') }}" method="POST">
            @csrf
            @if(isset($section))
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">Title</label>
                    <input type="text" name="title" value="{{ old('title', $section->title ?? '') }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">Content</label>
                    <textarea name="content" rows="6" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('content', $section->content ?? '') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Order</label>
                    <input type="number" name="order" value="{{ old('order', $section->order ?? 0) }}" class="w-full px-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700 focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <label class="flex items-center mt-6">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }} class="w-4 h-4 text-primary-600 border-slate-300 rounded focus:ring-primary-500">
                        <span class="ml-2 text-sm font-medium">Active</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex items-center space-x-4">
                <button type="submit" class="px-6 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                    {{ isset($section) ? 'Update Section' : 'Create Section' }}
                </button>
                <a href="{{ route('admin.sections.index') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
