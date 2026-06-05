<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\RedirectResponse;

class NotificationController extends Controller
{
    public function read(Notification $notification): RedirectResponse
    {
        $this->authorizeNotification($notification);

        if ($notification->read_at === null) {
            $notification->update(['read_at' => now()]);
        }

        return redirect($notification->url ?: route('dashboard.settings'));
    }

    public function markAllRead(): RedirectResponse
    {
        Notification::where('user_id', auth()->id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return back()->with('success', 'Semua notifikasi sudah ditandai dibaca.');
    }

    public function destroy(Notification $notification): RedirectResponse
    {
        $this->authorizeNotification($notification);
        $notification->delete();

        return back()->with('success', 'Notifikasi berhasil dihapus.');
    }

    private function authorizeNotification(Notification $notification): void
    {
        abort_unless($notification->user_id === auth()->id(), 403);
    }
}
