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
        <div id="projects-container">
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;" id="projects-grid">
                @foreach($projects->take(6) as $project)
                <div class="project-card" data-index="{{ $loop->index }}">
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
                            
                            @php
                            $description = is_array($project->description) ? ($project->description['ar'] ?? '') : $project->description;
                            $descLength = mb_strlen($description);
                            $truncatedDesc = $descLength > 80 ? mb_substr($description, 0, 80) . '...' : $description;
                            @endphp
                            
                            <div class="description-container" style="min-height:60px;">
                                <p class="description-short" style="margin:0 0 12px;color:#666;font-size:13px;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                    {{ $truncatedDesc }}
                                </p>
                                <p class="description-full" style="margin:0 0 12px;color:#666;font-size:13px;line-height:1.5;display:none;">
                                    {{ $description }}
                                </p>
                                
                                @if($descLength > 80)
                                <button onclick="toggleDescription(this)" 
                                        style="background:none;border:none;color:#6366f1;cursor:pointer;font-size:13px;padding:0;margin-bottom:12px;">
                                    المزيد <i class="fas fa-chevron-down" style="font-size:10px;margin-right:4px;"></i>
                                </button>
                                @endif
                            </div>
                            
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
                </div>
                @endforeach
            </div>

            @if($projects->count() > 6)
            <div style="display:flex;justify-content:center;gap:8px;margin-top:32px;" id="pagination">
                <button onclick="changePage(-1)" id="prev-btn" style="padding:8px 12px;background:#f3f4f6;color:#374151;border:none;border-radius:6px;cursor:pointer;">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                @for($i = 1; $i <= ceil($projects->count() / 6); $i++)
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
        var totalProjects = {{ $projects->count() }};
        var perPage = 6;
        var currentPage = 1;
        var totalPages = Math.ceil(totalProjects / perPage);

        function showPage(page) {
            currentPage = page;
            var cards = document.querySelectorAll('.project-card');
            cards.forEach(function(card, index) {
                var start = (page - 1) * perPage;
                var end = start + perPage;
                if (index >= start && index < end) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update pagination buttons
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
            
            // Update prev/next buttons
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

        function toggleDescription(btn) {
            var container = btn.parentElement;
            var shortDesc = container.querySelector('.description-short');
            var fullDesc = container.querySelector('.description-full');
            
            if (shortDesc.style.display === 'none') {
                shortDesc.style.display = '-webkit-box';
                fullDesc.style.display = 'none';
                btn.innerHTML = 'المزيد <i class="fas fa-chevron-down" style="font-size:10px;margin-right:4px;"></i>';
            } else {
                shortDesc.style.display = 'none';
                fullDesc.style.display = 'block';
                btn.innerHTML = 'أقل <i class="fas fa-chevron-up" style="font-size:10px;margin-right:4px;"></i>';
            }
        }

        // Initialize - hide extra cards
        showPage(1);
        </script>
    @else
        <div class="card" style="padding:48px;text-align:center;">
            <i class="fas fa-folder-open" style="font-size:48px;color:#ccc;margin-bottom:16px;display:block;"></i>
            <h3 style="margin:0 0 8px;">لا توجد مشاريع</h3>
            <p style="margin:0 0 20px;color:#666;">أضف مشروعك الأول</p>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">إضافة مشروع</a>
        </div>
    @endif
@endsection
