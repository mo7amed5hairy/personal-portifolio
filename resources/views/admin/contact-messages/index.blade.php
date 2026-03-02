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
            <tbody>
                @foreach($messages as $message)
                <tr>
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
        @else
        <div style="text-align:center;padding:40px;color:#64748b;">
            <i class="fas fa-inbox" style="font-size:48px;margin-bottom:15px;"></i>
            <p>لا توجد رسائل بعد</p>
        </div>
        @endif
    </div>
</div>
@endsection
