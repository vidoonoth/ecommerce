<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Events\ChatMessageSent;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $recipientId = $request->input('recipient_id');
        $messages = ChatMessage::where(function($q) use ($userId, $recipientId) {
            $q->where('user_id', $userId)->where('recipient_id', $recipientId);
        })->orWhere(function($q) use ($userId, $recipientId) {
            $q->where('user_id', $recipientId)->where('recipient_id', $userId);
        })->orderBy('created_at')->get();
        return response()->json($messages);
    }

    public function store(Request $request)
    {
        $message = ChatMessage::create([
            'user_id' => Auth::id(),
            'recipient_id' => $request->input('recipient_id'),
            'message' => $request->input('message'),
        ]);
        broadcast(new ChatMessageSent($message))->toOthers();
        return response()->json($message);
    }
}
