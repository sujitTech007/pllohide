@include('manufacturer.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>Messages</h3>
            <div class="search_bar">
                <label for="">Search</label>
                <input type="text" class="form-control" placeholder="Search conversations" id="search-conversations">
            </div>
        </div>
        <div class="messages_card">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="messages-list">
                        <div id="conversations-list">
                            @forelse($conversations as $conversation)
                                <div class="msg_crd cursor-pointer"
                                    onclick="openChatModal({{ $conversation['user']->id }}, '{{ $conversation['user']->name }}', '{{ $conversation['user']->profile_image ?? '/assets/images/default-avatar.png' }}', {{ $conversation['user']->role }})">
                                    <div class="d-flex align-items-center w-100">
                                        <img src="{{ asset($conversation['user']->profile_image ?? '/assets/images/default-avatar.png') }}"
                                             alt="" class="rounded-circle me-3" style="width: 50px; height: 50px;">
                                        <div class="flex-grow-1 w-100 d-flex justify-content-between align-items-center">
                                            <h3 class="mb-1">{{ $conversation['user']->name }}</h3>
                                            <p class="mb-0 text-white">{{ Str::limit($conversation['latest_message']->message, 50) }}...</p>
                                            <small class="text-white">{{ $conversation['latest_message']->created_at->diffForHumans() }}</small>
                                        </div>
                                        @if($conversation['unread_count'] > 0)
                                            <span class="badge bg-danger ms-2">{{ $conversation['unread_count'] }}</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="text-center p-5">
                                    <h5>No conversations yet</h5>
                                    <p class="text-muted">Start a conversation by sending a message to a designer or supplier.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chat Modal -->
<div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center">
                    <img id="modal-user-avatar" src="" alt="" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                    <div>
                        <h5 class="modal-title mb-0" id="modal-user-name"></h5>
                        <small class="text-muted" id="modal-user-role"></small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="chat-messages" id="chat-messages" style="height: 400px; overflow-y: auto; padding: 15px; background-color: #f8f9fa; border-radius: 8px;">
                    <!-- Messages will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <form id="send-message-form" class="w-100">
                    <div class="d-flex">
                        <input type="hidden" id="current-chat-user-id">
                        <textarea class="form-control me-2" id="message-input" placeholder="Type a message..." rows="2" style="resize: none;"></textarea>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentChatUserId = null;
let chatModal = null;
let messageInterval = null;
let lastMessageCount = 0;

document.addEventListener('DOMContentLoaded', function () {

    chatModal = new bootstrap.Modal(document.getElementById('chatModal'));

    loadConversations();

    // Refresh conversation list every 5 seconds
    setInterval(loadConversations, 5000);

    // Stop refreshing messages when modal closes
    document.getElementById('chatModal').addEventListener('hidden.bs.modal', function () {
        clearInterval(messageInterval);
    });

});

// ================= OPEN CHAT =================

function openChatModal(userId, userName, userAvatar, userRole) {

    currentChatUserId = userId;

    document.getElementById('current-chat-user-id').value = userId;

    document.getElementById('modal-user-avatar').src = userAvatar;

    document.getElementById('modal-user-name').innerHTML = userName;

    document.getElementById('modal-user-role').innerHTML =
        userRole == 2 ? 'Supplier'
        : userRole == 3 ? 'Manufacturer'
        : 'Designer';

    chatModal.show();

    loadMessages(userId);

    clearInterval(messageInterval);

    messageInterval = setInterval(function () {
        loadMessages(userId);
    }, 2000);

}

// ================= APPEND MESSAGE =================

function appendMessage(chat) {

    const chatMessages = document.getElementById('chat-messages');

    const own = chat.sender_id == {{ auth()->id() }};

    const time = new Date(chat.created_at).toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });

    chatMessages.innerHTML += `
        <div class="mb-3 ${own ? 'text-end' : 'text-start'}">

            <div class="d-inline-block ${own ? 'bg-primary text-white' : 'bg-white border'} p-3 rounded shadow-sm"
                 style="max-width:70%;">

                <div>${chat.message}</div>

                <small>${time}</small>

            </div>

        </div>
    `;

    chatMessages.scrollTop = chatMessages.scrollHeight;

}

// ================= LOAD MESSAGES =================

function loadMessages(userId) {

    fetch("{{ url('/chat/messages') }}/" + userId)

    .then(res => res.json())

    .then(messages => {

        const chatBox = document.getElementById('chat-messages');

        if (messages.length != lastMessageCount) {

            lastMessageCount = messages.length;

            chatBox.innerHTML = '';

            if (!messages.length) {

                chatBox.innerHTML =
                    '<div class="text-center text-muted">No messages yet.</div>';

                return;
            }

            messages.forEach(function (msg) {

                appendMessage(msg);

            });

        }

    });

}

// ================= LOAD CONVERSATIONS =================

function loadConversations() {

    fetch("{{ route('chat.messages') }}")

    .then(res => res.json())

    .then(data => {

        const list = document.getElementById('conversations-list');

        list.innerHTML = '';

        if (!data.length) {

            list.innerHTML =
                '<div class="text-center p-3">No conversations yet.</div>';

            return;

        }

        data.forEach(function (conv) {

            let avatar =
                conv.user.profile_image
                ? "{{ asset('') }}" + conv.user.profile_image
                : "{{ asset('assets/images/default-avatar.png') }}";

            let html = `
                <div class="msg_crd border-bottom p-2"
                     style="cursor:pointer;"

                     onclick="openChatModal(
                        '${conv.user.id}',
                        '${conv.user.name}',
                        '${avatar}',
                        '${conv.user.role}'
                     )">

                    <div class="d-flex align-items-center">

                        <img src="${avatar}"
                             onerror="this.src='{{ asset('assets/images/default-avatar.png') }}'"
                             class="rounded-circle me-3"
                             style="width:50px;height:50px;object-fit:cover;">

                        <div class="flex-grow-1 text-white">

                            <h6 class="mb-1 text-white fs-6">${conv.user.name}</h6>

                            <small class="text-white">
                                ${conv.latest_message.message}
                            </small>

                        </div>

                        ${
                            conv.unread_count > 0
                            ? `<span class="badge bg-danger">${conv.unread_count}</span>`
                            : ''
                        }

                    </div>

                </div>
            `;

            list.innerHTML += html;

        });

    });

}

// ================= SEND MESSAGE =================

document.getElementById('send-message-form').addEventListener('submit', function(e){

    e.preventDefault();

    let message = document.getElementById('message-input').value.trim();

    if(message == '') return;

    const fd = new FormData();

    fd.append('_token',"{{ csrf_token() }}");
    fd.append('receiver_id',currentChatUserId);
    fd.append('message',message);

    fetch("{{ route('chat.send') }}",{

        method:'POST',

        body:fd,

        headers:{
            Accept:'application/json'
        }

    })

    .then(res=>res.json())

    .then(function(data){

        if(data.success){

            document.getElementById('message-input').value='';

            appendMessage(data.chat);

            lastMessageCount++;

            loadConversations();

        }

    });

});
</script>

@include('manufacturer.include.footer')
