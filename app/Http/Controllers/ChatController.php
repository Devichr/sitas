<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;



class ChatController extends Controller
{

    public function show(Request $request){
        $selectedUserId = $request->input('user_id');
        $users = User::where('role', '!=', auth()->user()->role)->get();
        return view('chat.index', compact('users','selectedUserId'));


    }

    public function index()
{
    $users = User::where('role', '!=', auth()->user()->role)->get();
    return view('chat.index', compact('users'));
}

public function fetchMessages($userId)
{
    $messages = Message::where(function ($query) use ($userId) {
        $query->where('sender_id', auth()->id())
              ->where('receiver_id', $userId);
    })->orWhere(function ($query) use ($userId) {
        $query->where('sender_id', $userId)
              ->where('receiver_id', auth()->id());
    })->orderBy('created_at', 'asc')->with(['sender', 'receiver'])->get();


    // Update read_at for unread messages
    Message::where('sender_id', $userId)
           ->where('receiver_id', auth()->id())
           ->whereNull('read_at')
           ->update(['read_at' => now(), 'status' => 'read']);

    return response()->json($messages);

}

public function sendMessage(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'nullable|string',
        'file' => 'nullable|file|mimes:jpg,png,pdf,docx'
    ]);

    $message = new Message();
    $message->sender_id = auth()->id();
    $message->receiver_id = $request->receiver_id;
    $message->message = $request->message;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('uploads', 'public');
        $message->file_path = $filePath;
    }

    $message->save();

    return response()->json($message);
}

public function chatList()
{
    $users = User::where('role', '!=', auth()->user()->role)
        ->get()
        ->map(function ($user) {
            $user->unread_count = Message::where('sender_id', $user->id)
                ->where('receiver_id', auth()->id())
                ->where('status', '!=', 'read')
                ->count();
            return $user;
        });

    return response()->json($users);
}

}
