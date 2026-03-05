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
<div id="sections-container">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;" id="sections-grid">
    @foreach($sections as $index => $section)
    <div class="section-card" data-index="{{ $index }}">
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
                
                @php
                $content = $section->content ?? '';
                $contentLength = mb_strlen($content);
                $truncatedContent = $contentLength > 60 ? mb_substr($content, 0, 60) . '...' : $content;
                @endphp
                
                @if($contentLength > 0)
                <div class="content-container" style="min-height:50px;">
                    <p class="content-short" style="margin:0 0 12px;color:#888;font-size:12px;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $truncatedContent }}</p>
                    <p class="content-full" style="margin:0 0 12px;color:#888;font-size:12px;line-height:1.5;display:none;">{{ $content }}</p>
                    
                    @if($contentLength > 60)
                    <button onclick="toggleContent(this)" 
                            style="background:none;border:none;color:#6366f1;cursor:pointer;font-size:12px;padding:0;margin-bottom:12px;">
                        المزيد <i class="fas fa-chevron-down" style="font-size:-right:4px10px;margin;"></i>
                    </button>
                    @endif
                </div>
                @else
                <p style="margin:0 0 12px;color:#bbb;font-size:12px;font-style:italic;">لا يوجد محتوى</p>
                @endif

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
    </div>
    @endforeach
    </div>

    @if($sections->count() > 6)
    <div style="display:flex;justify-content:center;gap:8px;margin-top:32px;" id="pagination">
        <button onclick="changePage(-1)" id="prev-btn" style="padding:8px 12px;background:#f3f4f6;color:#374151;border:none;border-radius:6px;cursor:pointer;">
            <i class="fas fa-chevron-right"></i>
        </button>
        
        @for($i = 1; $i <= ceil($sections->count() / 6); $i++)
        <button onclick="goToPage({{ $i }})" class="page-btn" data-page="{{ $i }}" 
                style="padding:8px 12px;border-radius:6px;border:none;cursor:pointer;{{ $i == 1 ? 'background:#6366f1;color:white;' : 'background:#f3f4f6;color:#374151;' }}">
            {{ $i }}
        </button>
        @endfor
        
        <button onclick="changePage(1)" id="next-btn" style="padding:8px 12px;background:#6366f1;color:white;border:none;border-radius:6px;cursor:pointer;">
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>
    @endif
</div>

<script>
var totalSections = {{ $sections->count() }};
var perPage = 6;
var currentPage = 1;
var totalPages = Math.ceil(totalSections / perPage);

function showPage(page) {
    currentPage = page;
    var cards = document.querySelectorAll('.section-card');
    cards.forEach(function(card, index) {
        var start = (page - 1) * perPage;
        var end = start + perPage;
        if (index >= start && index < end) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
    
    document.querySelectorAll('.page-btn').forEach(function(btn) {
        var btnPage = parseInt(btn.dataset.page);
        if (btnPage === page) {
            btn.style.background = '#6366f1';
            btn.style.color = 'white';
        } else {
            btn.style.background = '#f3f4f6';
            btn.style.color = '#374151';
        }
    });
    
    document.getElementById('prev-btn').style.opacity = page === 1 ? '0.5' : '1';
    document.getElementById('next-btn').style.opacity = page === totalPages ? '0.5' : '1';
}

function changePage(delta) {
    var newPage = currentPage + delta;
    if (newPage >= 1 && newPage <= totalPages) {
        showPage(newPage);
    }
}

function goToPage(page) {
    showPage(page);
}

function toggleContent(btn) {
    var container = btn.parentElement;
    var shortContent = container.querySelector('.content-short');
    var fullContent = container.querySelector('.content-full');
    
    if (shortContent.style.display === 'none') {
        shortContent.style.display = '-webkit-box';
        fullContent.style.display = 'none';
        btn.innerHTML = 'المزيد <i class="fas fa-chevron-down" style="font-size:10px;margin-right:4px;"></i>';
    } else {
        shortContent.style.display = 'none';
        fullContent.style.display = 'block';
        btn.innerHTML = 'أقل <i class="fas fa-chevron-up" style="font-size:10px;margin-right:4px;"></i>';
    }
}

showPage(1);
</script>
@else
<div class="card" style="padding:48px;text-align:center;">
    <i class="fas fa-layer-group" style="font-size:48px;color:#ccc;margin-bottom:16px;display:block;"></i>
    <h3 style="margin:0 0 8px;">لا توجد أقسام</h3>
    <a href="{{ route('admin.sections.create') }}" class="btn btn-primary">إضافة قسم</a>
</div>
@endif
@endsection
