@include('admin.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>All Chat Conversations</h3>
        </div>
        <div class="messages_card">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Conversation</th>
                                    <th>Latest Message</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($chats as $conversationKey => $conversationMessages)
                                    @php
                                        $latestMessage = $conversationMessages->first();
                                        $sender = $latestMessage->sender;
                                        $receiver = $latestMessage->receiver;
                                        $senderRole = $sender->role == 1 ? 'Designer' : ($sender->role == 2 ? 'Supplier' : 'Manufacturer');
                                        $receiverRole = $receiver->role == 1 ? 'Designer' : ($receiver->role == 2 ? 'Supplier' : 'Manufacturer');
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <img src="{{ asset($sender->profile_image) }}" alt="" class="rounded-circle" style="width: 40px; height: 40px;">
                                                </div>
                                                <div class="me-3">
                                                    <img src="{{ asset($receiver->profile_image) }}" alt="" class="rounded-circle" style="width: 40px; height: 40px;">
                                                </div>
                                                <div>
                                                    <strong>{{ $sender->name }} ({{ $senderRole }})</strong><br>
                                                    <small class="text-muted">↔ {{ $receiver->name }} ({{ $receiverRole }})</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="message-preview">
                                                {{ Str::limit($latestMessage->message, 100) }}
                                            </div>
                                        </td>
                                        <td>
                                            <small>{{ $latestMessage->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            @if($latestMessage->is_read)
                                                <span class="badge bg-success">Read</span>
                                            @else
                                                <span class="badge bg-warning">Unread</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No conversations found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.message-preview {
    max-width: 300px;
    word-wrap: break-word;
}
</style>

@include('admin.include.footer')
