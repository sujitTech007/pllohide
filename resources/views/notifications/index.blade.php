
@if(auth()->user()->role == '1')
@include('designer.include.header')
@elseif(auth()->user()->role == '2')
@include('supplier.include.header')
@elseif(auth()->user()->role == '3')
@include('manufacturer.include.header')
@endif

<style>
    .notification-date .date-box {
    background-color: #fff4e6; /* soft beige */
    padding: 15px 10px;
    border-radius: 10px;
    display: inline-block;
    width: 60px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.notification-date .day,
.notification-date .month {
    font-weight: 500;
    color: #8B4513; /* rich brown */
    font-size: 16px;
    
    line-height: 1.2;
}
</style>

<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Notifications</h3>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-primary" onclick="markAllAsRead()">Mark All as Read</button>
                <button class="btn btn-sm btn-outline-danger" onclick="clearAllNotifications()">Clear All</button>
            </div>
        </div>
        
        <div class="notifications_card">
            @forelse($notifications as $notification)

                
                <div class="notification-item {{ $notification->is_read ? 'read' : 'unread' }}" 
                     onclick="markAsRead({{ $notification->id }})">
                    <div class="d-flex align-items-start">
                       <div class="notification-date me-3 text-center ">
    <div class="day">{{ $notification->created_at->format('d') }}</div> 
    <div class="month">{{ $notification->created_at->format('M') }}</div>
</div>
                        <div class="notification-icon me-3">
                            @switch($notification->type)
                                @case('quotation')
                                    <i class="fas fa-file-invoice text-primary"></i>
                                    @break
                                @case('message')
                                    <i class="fas fa-comment text-info"></i>
                                    @break
                                @case('registration')
                                    <i class="fas fa-user-plus text-success"></i>
                                    @break
                                @case('payment')
                                    <i class="fas fa-credit-card text-warning"></i>
                                    @break
                                @case('plan_purchase')
                                    <i class="fas fa-crown text-purple"></i>
                                    @break
                                @default
                                    <i class="fas fa-bell text-secondary"></i>
                            @endswitch
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="mb-1">{{ $notification->title }}</h5>
                                <div class="d-flex gap-2">
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    @if(!$notification->is_read)
                                        <span class="badge bg-primary">New</span>
                                    @endif
                                </div>
                            </div>
                            <p class="mb-2 text-muted">{{ $notification->message }}</p>
                            @if($notification->fromUser)
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i>
                                    From: {{ $notification->fromUser->name }}
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center p-5">
                    <i class="fas fa-bell-slash fa-3x text-muted mb-3"></i>
                    <h5>No notifications yet</h5>
                    <p class="text-muted">You'll see notifications here when you receive messages, quotations, or other updates.</p>
                </div>
            @endforelse
            
            @if($notifications->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.notifications_card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    overflow: hidden;
}

.notification-item {
    padding: 15px 20px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background-color 0.2s;
}

.notification-item:hover {
    background-color: #f8f9fa;
}

.notification-item.unread {
    background-color: #f0f8ff;
    border-left: 4px solid #007bff;
}

.notification-item.read {
    opacity: 0.7;
}

.notification-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 50%;
    font-size: 18px;
}

.text-purple {
    color: #6f42c1 !important;
}
</style>

<script>
function markAsRead(notificationId) {
    
        const markAsReadUrl = `{{ route('notifications.mark-read', ':notificationId') }}`.replace(':notificationId', notificationId);
        
        fetch(markAsReadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })

    // fetch(`/notifications/${notificationId}/mark-read`, {
    //     method: 'POST',
    //     headers: {
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //         'Content-Type': 'application/json'
    //     }
    // })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the notification item visually
            const notificationItem = document.querySelector(`[onclick="markAsRead(${notificationId})"]`);
            if (notificationItem) {
                notificationItem.classList.remove('unread');
                notificationItem.classList.add('read');
                const badge = notificationItem.querySelector('.badge');
                if (badge) {
                    badge.remove();
                }
            }
            // Update header notification count
            updateNotificationCount();
        }
    })
    .catch(error => console.error('Error marking notification as read:', error));
}

function markAllAsRead() {
    if (confirm('Mark all notifications as read?')) {
        const markAsReadUrl = `{{ route('notifications.mark-all-read') }}`;
        
        fetch(markAsReadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })

        // fetch('/notifications/mark-all-read', {
        //     method: 'POST',
        //     headers: {
        //         'X-CSRF-TOKEN': '{{ csrf_token() }}',
        //         'Content-Type': 'application/json'
        //     }
        // })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error marking all as read:', error));
    }
}

function clearAllNotifications() {
    if (confirm('Are you sure you want to clear all notifications? This action cannot be undone.')) {
        fetch('/notifications', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        })
        .catch(error => console.error('Error clearing notifications:', error));
    }
}

function updateNotificationCount() {
    const unreadCountUrl = `{{ route('notifications.unread-count') }}`;
    fetch(unreadCountUrl, {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    // fetch('/notifications/unread-count')
        .then(response => response.json())
        .then(data => {
            const countElement = document.getElementById('notification-count');
            if (countElement) {
                countElement.textContent = data.count;
                if (data.count > 0) {
                    countElement.style.display = 'inline';
                } else {
                    countElement.style.display = 'none';
                }
            }
        })
        .catch(error => console.error('Error updating notification count:', error));
}
</script>

@if(auth()->user()->role == '1')
@include('designer.include.footer')
@elseif(auth()->user()->role == '2')
@include('supplier.include.footer')
@elseif(auth()->user()->role == '3')
@include('manufacturer.include.footer')
@endif
