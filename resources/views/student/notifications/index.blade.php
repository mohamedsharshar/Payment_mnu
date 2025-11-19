@extends('layouts.student')

@section('title', 'الإشعارات - بوابة الطالب')
@section('page-title', 'الإشعارات')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-bell me-2"></i>الإشعارات</span>
                @if($unreadCount > 0)
                <div>
                    <span class="badge bg-danger">{{ $unreadCount }} جديد</span>
                    <form action="{{ route('student.notifications.markAllAsRead') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-primary text-white">
                            <i class="bi bi-check-all me-1"></i>تحديد الكل كمقروء
                        </button>
                    </form>
                </div>
                @endif
            </div>
            <div class="card-body p-0">
                @if($notifications->count() > 0)
                <div class="list-group list-group-flush">
                    @foreach($notifications as $notification)
                    <div class="list-group-item {{ is_null($notification->read_at) ? 'bg-light' : '' }}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-receipt text-primary me-2" style="font-size: 1.2rem;"></i>
                                    <h6 class="mb-0">
                                        @if(isset($notification->data['service_name']))
                                            {{ $notification->data['service_name'] }}
                                        @else
                                            إشعار جديد
                                        @endif
                                    </h6>
                                    @if(is_null($notification->read_at))
                                        <span class="badge bg-primary ms-2">جديد</span>
                                    @endif
                                </div>
                                <p class="mb-2 text-muted">
                                    {{ $notification->data['message'] ?? 'لديك إشعار جديد' }}
                                </p>
                                @if(isset($notification->data['amount']))
                                <p class="mb-2">
                                    <strong>المبلغ:</strong> {{ number_format($notification->data['amount'], 2) }} ج.م
                                </p>
                                @endif
                                <small class="text-muted">
                                    <i class="bi bi-clock me-1"></i>{{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                            <div class="d-flex gap-2">
                                @if(is_null($notification->read_at))
                                <form action="{{ route('student.notifications.markAsRead', $notification->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success" title="تحديد كمقروء">
                                        <i class="bi bi-check"></i>
                                    </button>
                                </form>
                                @endif
                                <form action="{{ route('student.notifications.destroy', $notification->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="حذف">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer bg-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            عرض {{ $notifications->firstItem() }} إلى {{ $notifications->lastItem() }} من {{ $notifications->total() }} إشعار
                        </div>
                        <div>
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-5">
                    <i class="bi bi-bell-slash" style="font-size: 4rem; color: #dee2e6;"></i>
                    <h5 class="mt-3 text-muted">لا توجد إشعارات</h5>
                    <p class="text-muted">سيتم إشعارك بأي تحديثات هنا</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
