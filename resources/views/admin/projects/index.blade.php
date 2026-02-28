@extends('layouts.admin')

@section('title', 'المشاريع')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <div>
            <h2 style="margin:0;font-size:24px;font-weight:bold;">المشاريع</h2>
            <p style="margin:4px 0 0;color:#666;">إدارة مشاريع معرض أعمالك</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة مشروع
        </a>
    </div>

    @if($projects->count() > 0)
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;">
            @foreach($projects as $project)
                <div class="card">
                    <div style="aspect-ratio:16/9;position:relative;background:#f5f5f5;">
                        <img src="{{ $project->getImageUrl() ?: 'https://via.placeholder.com/600x400?text=Project' }}" 
                             alt="{{ is_array($project->title) ? ($project->title['ar'] ?? '') : $project->title }}" 
                             style="width:100%;height:100%;object-fit:cover;">
                        @if($project->is_featured)
                            <span style="position:absolute;top:10px;left:10px;padding:4px 10px;background:#f59e0b;color:white;border-radius:20px;font-size:12px;font-weight:bold;">
                                <i class="fas fa-star"></i> مميز
                            </span>
                        @endif
                    </div>
                    <div style="padding:16px;">
                        <h3 style="margin:0 0 8px;font-size:16px;font-weight:bold;">
                            {{ is_array($project->title) ? ($project->title['ar'] ?? '') : $project->title }}
                        </h3>
                        <p style="margin:0 0 12px;color:#666;font-size:13px;line-height:1.5;">
                            {{ is_array($project->description) ? ($project->description['ar'] ?? '') : $project->description }}
                        </p>
                        
                        <div style="display:flex;justify-content:space-between;align-items:center;padding-top:12px;border-top:1px solid #eee;">
                            <span style="font-size:13px;color:#999;">#{{ $project->order }}</span>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.projects.edit', $project) }}" style="padding:8px 12px;background:#e0f2fe;color:#0284c7;border-radius:6px;text-decoration:none;font-size:13px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('هل أنت متأكد من الحذف؟')" 
                                            style="padding:8px 12px;background:#fee2e2;color:#dc2626;border:none;border-radius:6px;cursor:pointer;font-size:13px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card" style="padding:48px;text-align:center;">
            <i class="fas fa-folder-open" style="font-size:48px;color:#ccc;margin-bottom:16px;display:block;"></i>
            <h3 style="margin:0 0 8px;">لا توجد مشاريع</h3>
            <p style="margin:0 0 20px;color:#666;">أضف مشروعك الأول</p>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">إضافة مشروع</a>
        </div>
    @endif
@endsection
