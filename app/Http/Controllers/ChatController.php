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
            // Jika yang mengakses sedang berada di admin chat dan membuka room user ini,
            // tandai pesan yang belum dibaca dari user menjadi terbaca
            if (auth()->check() && auth()->user()->role === 'admin_pusat') {
                Message::where('user_id', $room_id)
                    ->where('sender', '!=', 'admin')
                    ->where('is_read', false)
                    ->update(['is_read' => true]);
            }

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
         * Ambil semua user yang memiliki riwayat chat,
         * diurutkan berdasarkan waktu pesan terakhir (terbaru di atas),
         * dan sertakan jumlah pesan unread dari customer.
         */
        $users = User::whereNotIn('role', ['admin_pusat', 'admin_jurusan'])
            ->whereHas('messages')
            ->withCount(['messages as unread_count' => function ($q) {
                $q->where('sender', '!=', 'admin')->where('is_read', false);
            }])
            ->withMax('messages', 'created_at')
            ->orderByDesc('messages_max_created_at')
            ->get();

        /*
         * User yang sedang dipilih di Admin.
         * Kalau belum memilih, otomatis pilih user pertama (pesan terbaru).
         */
        $selectedUserId = $request->user_id;

        if (!$selectedUserId) {
            $selectedUserId = $users->first()->id ?? null;
        }

        /*
         * Tandai pesan dari user yang sedang dibuka menjadi terbaca (is_read = true).
         */
        if ($selectedUserId) {
            Message::where('user_id', $selectedUserId)
                ->where('sender', '!=', 'admin')
                ->where('is_read', false)
                ->update(['is_read' => true]);

            // Refresh status unread_count untuk user yang aktif di list
            $activeUser = $users->firstWhere('id', $selectedUserId);
            if ($activeUser) {
                $activeUser->unread_count = 0;
            }
        }

        /*
         * Total unread chat untuk badge menu sidebar
         */
        $unread_chat = Message::where('sender', '!=', 'admin')
            ->where('is_read', false)
            ->count();

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
            'selectedUserId',
            'unread_chat'
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

