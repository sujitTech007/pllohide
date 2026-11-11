<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;
use App\Models\Notification;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        try {
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
                'message'     => 'required|string',
            ]);

            $chat = Chat::create([
                'sender_id'   => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'message'     => $request->message,
            ]);

            // Create notification for receiver (optional)
            Notification::createMessageNotification($chat);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully!',
                'chat'    => $chat->load(['sender', 'receiver'])
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error sending message: ' . $e->getMessage()
            ], 500);
        }
    }
    
     public function sendQuote(Request $request)
    {
        
            $request->validate([
                'receiver_id' => 'required|exists:users,id',
                'message'     => 'required|string',
            ]);

            $chat = Chat::create([
                'sender_id'   => Auth::id(),
                'receiver_id' => $request->receiver_id,
                'message'     => $request->message,
            ]);

            // Create notification for receiver (optional)
            Notification::createMessageNotification($chat);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
    

    public function getMessages($userId = null)
    {
        $currentUserId = Auth::id();

        if ($userId) {
            $messages = Chat::where(function($q) use ($currentUserId, $userId) {
                    $q->where('sender_id', $currentUserId)->where('receiver_id', $userId);
                })
                ->orWhere(function($q) use ($currentUserId, $userId) {
                    $q->where('sender_id', $userId)->where('receiver_id', $currentUserId);
                })
                ->with(['sender', 'receiver'])
                ->orderBy('created_at')
                ->get();

            // Mark messages as read
            Chat::where('sender_id', $userId)
                ->where('receiver_id', $currentUserId)
                ->where('is_read', false)
                ->update(['is_read' => true]);

            return response()->json($messages);
        }

        // Conversations list
        $conversations = Chat::where('sender_id', $currentUserId)
            ->orWhere('receiver_id', $currentUserId)
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($chat) use ($currentUserId) {
                return $chat->sender_id == $currentUserId ? $chat->receiver_id : $chat->sender_id;
            })
            ->map(function($chats) use ($currentUserId) {
                $latest = $chats->first();
                $other  = $latest->sender_id == $currentUserId ? $latest->receiver : $latest->sender;
                $unread = $chats->where('receiver_id', $currentUserId)->where('is_read', false)->count();

                return [
                    'user'           => $other,
                    'latest_message' => $latest,
                    'unread_count'   => $unread,
                ];
            });

        return response()->json($conversations->values());
    }

    public function markAsRead($userId)
    {
        Chat::where('sender_id', $userId)
            ->where('receiver_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
