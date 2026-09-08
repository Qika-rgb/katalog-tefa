<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function customerService()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();

        return view('customer-service', compact('messages'));
    }

    public function adminChat()
    {
        $messages = Message::orderBy('created_at', 'asc')->get();

        return view('admin-pusat-chat', compact('messages'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'user_id' => auth()->id(),
            'pesanan_id' => $request->pesanan_id,
            'sender' => $request->sender ?? 'user',
            'message' => $request->message,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}