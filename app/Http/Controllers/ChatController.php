<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function customerService()
{
    // Misal kita ambil user_id yang sedang aktif (misal user dengan ID 1 atau auth()->id())
    $room_id = 1; // Kita jadikan room_id ini sebagai patokan user_id

    // Ambil pesan berdasarkan user_id tersebut
    $messages = \App\Models\Message::where('user_id', $room_id)
                    ->orderBy('created_at', 'asc')
                    ->get();

    return view('customer-service', compact('room_id', 'messages'));
}

public function fetchPesans($room_id)
{
    try {
        // Cari pesan berdasarkan user_id (menggantikan room_id)
        $pesans = \App\Models\Message::where('user_id', $room_id)
                        ->orderBy('created_at', 'asc')
                        ->get();
                        
        return response()->json($pesans);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
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
        'user_id' => $request->user_id ?? (auth()->id() ?? 1),
        'pesanan_id' => $request->pesanan_id,
        'sender' => $request->sender ?? 'user',
        'message' => $request->message,
    ]);

    return back();
}
}