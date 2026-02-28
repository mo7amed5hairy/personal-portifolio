@extends('layouts.admin')

@section('title', 'الأقسام')

@section('content')
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:24px;">
        <div>
            <h2 style="margin:0;font-size:24px;font-weight:bold;">الأقسام</h2>
            <p style="margin:4px 0 0;color:#666;">إدارة أقسام الموقع</p>
        </div>
        <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> إضافة قسم
        </a>
    </div>

    @if($sections->count() > 0)
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;">
            @foreach($sections as $section)
                <div class="card">
                    @if($section->getImageUrl())
                        <div style="aspect-ratio:16/9;background:#f5f5f5;">
                            <img src="{{ $section->getImageUrl() }}" alt="{{ $section->getLocalizedTitle() }}" style="width:100%;height:100%;object-fit:cover;">
                        </div>
                    @endif
                    <div style="padding:16px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                            <h3 style="margin:0;font-size:16px;font-weight:bold;">{{ $section->getLocalizedTitle() }}</h3>
                            @if($section->is_active)
                                <span style="padding:4px 10px;background:#d1fae5;color:#059669;border-radius:20px;font-size:11px;">نشط</span>
                            @else
                                <span style="padding:4px 10px;background:#f3f4f6;color:#666;border-radius:20px;font-size:11px;">غير نشط</span>
                            @endif
                        </div>
                        <p style="margin:0 0 12px;color:#666;font-size:13px;">{{ $section->slug }}</p>
                        
                        <div style="display:flex;justify-content:space-between;align-items:center;padding-top:12px;border-top:1px solid #eee;">
                            <span style="font-size:13px;color:#999;">الترتيب: {{ $section->order }}</span>
                            <div style="display:flex;gap:8px;">
                                <a href="{{ route('admin.sections.edit', $section) }}" style="padding:8px 12px;background:#e0f2fe;color:#0284c7;border-radius:6px;text-decoration:none;font-size:13px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" style="display:inline;">
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
            <i class="fas fa-layer-group" style="font-size:48px;color:#ccc;margin-bottom:16px;display:block;"></i>
            <h3 style="margin:0 0 8px;">لا توجد أقسام</h3>
            <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">إضافة قسم</a>
        </div>
    @endif
@endsection
