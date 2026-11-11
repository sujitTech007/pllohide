@include('manufacturer.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Notifications</h3>

        </div>



        <div class="messages_card dasp_grap">
            <div class="tab_notif brd_btm">
                <div class="list_tab">
                    <div class="flex-column nav nav-pills" role="tablist" id="pills-tab" role="tablist">
                        <div class="nav-item" role="presentation">

                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
                        </div>
                        <div class="nav-item">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Unread</button>

                        </div>
                    </div>
                </div>
                <div class="search_bar"><label for="Search">Search</label><input type="text"
                        class="form-control" placeholder="Search"><span><svg
                            xmlns="http://www.w3.org/2000/svg" width="19" height="20"
                            viewBox="0 0 19 20" fill="none">
                            <path
                                d="M14.994 14.1715L19 18.1765L17.6765 19.5L13.6715 15.494C12.1813 16.6887 10.3278 17.3384 8.41784 17.3357C3.77119 17.3357 0 13.5645 0 8.91784C0 4.27119 3.77119 0.5 8.41784 0.5C13.0645 0.5 16.8357 4.27119 16.8357 8.91784C16.8384 10.8278 16.1887 12.6813 14.994 14.1715ZM13.1178 13.4775C14.3048 12.2568 14.9677 10.6205 14.965 8.91784C14.965 5.30004 12.0347 2.37063 8.41784 2.37063C4.80004 2.37063 1.87063 5.30004 1.87063 8.91784C1.87063 12.5347 4.80004 15.465 8.41784 15.465C10.1205 15.4677 11.7568 14.8048 12.9775 13.6178L13.1178 13.4775Z"
                                fill="#828282"></path>
                        </svg></span></div>
            </div>
            <div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="prof_box nofi_bx">
                            @forelse($notifications as $notification)
                            <div class="crd_bx">
                                <div class="mnth_emp">
                                    <div class="day_bx">{{ $notification->created_at->format('d M') }}</div>
                                    <div class="title_cont">
                                        <h3>{{ $notification->title }}</h3>
                                        <p class="text-muted mb-2">{{ $notification->message }}</p>
                                        <small class="text-muted">
                                            From: {{ $notification->fromUser->name ?? 'System' }} | 
                                            Type: {{ ucfirst($notification->type) }} | 
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div class="btn_grp">
                                    @if(!$notification->is_read)
                                        <span class="badge bg-primary">New</span>
                                    @endif
                                    <button class="btn" onclick="markAsRead({{ $notification->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M16.6823 8.1625C16.8868 8.39219 17 8.6906 17 9C17 9.3094 16.8868 9.60781 16.6823 9.8375C15.3875 11.25 12.4404 14 9 14C5.55961 14 2.61247 11.25 1.3177 9.8375C1.1132 9.60781 1 9.3094 1 9C1 8.6906 1.1132 8.39219 1.3177 8.1625C2.61247 6.75 5.55961 4 9 4C12.4404 4 15.3875 6.75 16.6823 8.1625Z" stroke="#109CD8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.57143 11.5686C10.9916 11.5686 12.1429 10.4174 12.1429 8.99721C12.1429 7.57705 10.9916 6.42578 9.57143 6.42578C8.15127 6.42578 7 7.57705 7 8.99721C7 10.4174 8.15127 11.5686 9.57143 11.5686Z" stroke="#109CD8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="text-center p-4">
                                <i class="fas fa-bell fa-3x text-muted mb-3"></i>
                                <h6>No notifications found</h6>
                                <p class="text-muted">Notifications will appear here.</p>
                            </div>
                            @endforelse
                            
                            @if($notifications->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $notifications->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade p-5" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                        <div class="prof_box nofi_bx">
                            @php
                                $unreadNotifications = $notifications->where('is_read', false);
                            @endphp
                            
                            @forelse($unreadNotifications as $notification)
                            <div class="crd_bx">
                                <div class="mnth_emp">
                                    <div class="day_bx">{{ $notification->created_at->format('d M') }}</div>
                                    <div class="title_cont">
                                        <h3>{{ $notification->title }}</h3>
                                        <p class="text-muted mb-2">{{ $notification->message }}</p>
                                        <small class="text-muted">
                                            From: {{ $notification->fromUser->name ?? 'System' }} | 
                                            Type: {{ ucfirst($notification->type) }} | 
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </div>
                                <div class="btn_grp">
                                    <span class="badge bg-primary">New</span>
                                    <button class="btn" onclick="markAsRead({{ $notification->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                            <path d="M16.6823 8.1625C16.8868 8.39219 17 8.6906 17 9C17 9.3094 16.8868 9.60781 16.6823 9.8375C15.3875 11.25 12.4404 14 9 14C5.55961 14 2.61247 11.25 1.3177 9.8375C1.1132 9.60781 1 9.3094 1 9C1 8.6906 1.1132 8.39219 1.3177 8.1625C2.61247 6.75 5.55961 4 9 4C12.4404 4 15.3875 6.75 16.6823 8.1625Z" stroke="#109CD8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M9.57143 11.5686C10.9916 11.5686 12.1429 10.4174 12.1429 8.99721C12.1429 7.57705 10.9916 6.42578 9.57143 6.42578C8.15127 6.42578 7 7.57705 7 8.99721C7 10.4174 8.15127 11.5686 9.57143 11.5686Z" stroke="#109CD8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="text-center p-4">
                                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                                <h6>All notifications are read</h6>
                                <p class="text-muted">You're all caught up!</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('manufacturer.include.footer')

<script>
function markAsRead(notificationId) {
    
    fetch(`/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Remove the "New" badge
            const badge = document.querySelector(`button[onclick="markAsRead(${notificationId})"]`).parentElement.querySelector('.badge');
            if (badge) {
                badge.remove();
            }
            // Optionally reload the page to update the UI
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>