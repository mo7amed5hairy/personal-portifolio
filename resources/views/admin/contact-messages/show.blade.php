@extends('layouts.admin')

@section('title', 'تفاصيل الرسالة')
@section('header-icon', 'envelope')

@section('content')
<div class="card">
    <div class="card-header">
        <h3><i class="fas fa-envelope"></i> تفاصيل الرسالة</h3>
    </div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:24px;margin-bottom:30px;">
            <div>
                <label class="form-label">الاسم</label>
                <p style="font-size:16px;color:#1e293b;">{{ $message->name }}</p>
            </div>
            <div>
                <label class="form-label">البريد الإلكتروني</label>
                <p style="font-size:16px;color:#1e293b;">{{ $message->email }}</p>
            </div>
            <div>
                <label class="form-label">رقم الهاتف</label>
                <p style="font-size:16px;color:#1e293b;">{{ $message->phone ?? '-' }}</p>
            </div>
            <div>
                <label class="form-label">تاريخ الإرسال</label>
                <p style="font-size:16px;color:#1e293b;">{{ $message->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>

        <div style="margin-bottom:30px;">
            <label class="form-label">الموضوع</label>
            <p style="font-size:18px;font-weight:600;color:#1e293b;">{{ $message->subject }}</p>
        </div>

        <div style="margin-bottom:30px;">
            <label class="form-label">الرسالة</label>
            <div style="background:#f8fafc;padding:20px;border-radius:12px;border:1px solid #e2e8f0;">
                <p style="font-size:16px;line-height:1.8;color:#334155;white-space:pre-wrap;">{{ $message->message }}</p>
            </div>
        </div>

        <div style="display:flex;gap:12px;justify-content:flex-start;">
            @if(!$message->is_read)
            <form method="POST" action="{{ route('admin.contact-messages.markAsRead', $message->id) }}">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> تحديد كمقروء
                </button>
            </form>
            @else
            <form method="POST" action="{{ route('admin.contact-messages.markAsUnread', $message->id) }}">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> تحديد كغير مقروء
                </button>
            </form>
            @endif

            @if($message->email)
            <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                <i class="fas fa-reply"></i> رد على الرسالة
            </a>
            @endif

            <form method="POST" action="{{ route('admin.contact-messages.destroy', $message->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                    <i class="fas fa-trash"></i> حذف
                </button>
            </form>

            <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-right"></i> رجوع
            </a>
        </div>
    </div>
</div>
@endsection
