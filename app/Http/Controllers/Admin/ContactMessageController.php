<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        $unreadCount = ContactMessage::unread()->count();

        return view('admin.contact.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $message)
    {
        $message->markAsRead();

        return view('admin.contact.show', compact('message'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }

    public function markAllRead()
    {
        ContactMessage::unread()->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Semua pesan ditandai sudah dibaca.');
    }
}
