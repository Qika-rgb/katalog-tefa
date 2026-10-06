<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function customerService()
    {
        // Ambil ID user yang sedang login
        $room_id = auth()->id() ?? 1;

        // Ambil pesan milik user tersebut
        $messages = Message::where('user_id', $room_id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('customer-service', compact('room_id', 'messages'));
    }

    public function fetchPesans($room_id)
    {
        try {
            // Ambil pesan berdasarkan user_id
            $pesans = Message::where('user_id', $room_id)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json($pesans);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function adminChat(Request $request)
    {
        /*
         * Ambil semua user yang pernah mengirim chat.
         * Jadi tidak hanya user ID 1.
         */
        $userIds = Message::whereNotNull('user_id')
            ->where('sender', 'user')
            ->distinct()
            ->pluck('user_id');

       $users = User::whereIn('id', $userIds)
    ->whereNotIn('role', ['admin_pusat', 'admin_jurusan'])
    ->get();

        /*
         * User yang sedang dipilih di Admin.
         * Kalau belum memilih, otomatis pilih user pertama
         * yang pernah chat.
         */
        $selectedUserId = $request->user_id;

        if (!$selectedUserId) {
            $selectedUserId = $users->first()->id ?? null;
        }

        /*
         * Ambil semua pesan hanya dari user yang sedang dipilih.
         */
        $messages = collect();

        if ($selectedUserId) {
            $messages = Message::where('user_id', $selectedUserId)
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('admin-pusat-chat', compact(
            'messages',
            'users',
            'selectedUserId'
        ));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'user_id' => 'required|integer',
        ]);

        Message::create([
            'user_id' => $request->user_id,
            'pesanan_id' => $request->pesanan_id,
            'sender' => $request->sender ?? 'admin',
            'message' => $request->message,
        ]);

        return back();
    }
}

