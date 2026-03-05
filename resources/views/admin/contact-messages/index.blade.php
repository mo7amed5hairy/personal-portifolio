@extends('layouts.admin')

@section('title', 'رسائل التواصل')
@section('header-icon', 'envelope')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-envelope"></i> رسائل التواصل</h3>
    </div>
    <div class="card-body">
        @if($messages->count() > 0)
        <div id="messages-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الموضوع</th>
                        <th>الحالة</th>
                        <th>التاريخ</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody id="messages-body">
                    @foreach($messages as $index => $message)
                    <tr class="message-row" data-index="{{ $index }}">
                        <td>{{ $message->id }}</td>
                        <td>
                            @if(!$message->is_read)
                            <span class="badge badge-danger">جديد</span>
                            @endif
                            {{ $message->name }}
                        </td>
                        <td>{{ $message->email }}</td>
                        <td>{{ $message->subject }}</td>
                        <td>
                            @if($message->is_read)
                            <span class="badge badge-success">مقروء</span>
                            @else
                            <span class="badge badge-warning">غير مقروء</span>
                            @endif
                        </td>
                        <td>{{ $message->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> عرض
                            </a>
                            <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($messages->count() > 10)
            <div style="display:flex;justify-content:center;gap:8px;margin-top:32px;" id="pagination">
                <button onclick="changePage(-1)" id="prev-btn" style="padding:8px 12px;background:#f3f4f6;color:#374151;border:none;border-radius:6px;cursor:pointer;">
                    <i class="fas fa-chevron-right"></i>
                </button>
                
                @for($i = 1; $i <= ceil($messages->count() / 10); $i++)
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
        var totalMessages = {{ $messages->count() }};
        var perPage = 10;
        var currentPage = 1;
        var totalPages = Math.ceil(totalMessages / perPage);

        function showPage(page) {
            currentPage = page;
            var rows = document.querySelectorAll('.message-row');
            rows.forEach(function(row, index) {
                var start = (page - 1) * perPage;
                var end = start + perPage;
                if (index >= start && index < end) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
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

        showPage(1);
        </script>
        @else
        <div style="text-align:center;padding:40px;color:#64748b;">
            <i class="fas fa-inbox" style="font-size:48px;margin-bottom:15px;"></i>
            <p>لا توجد رسائل بعد</p>
        </div>
        @endif
    </div>
</div>
@endsection
