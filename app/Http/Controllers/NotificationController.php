<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('notifications.index', [
            'title'         => 'Notifications',
            'active'        => 'notifications',
            'notifications' => $notifications,
        ]);
    }

    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->delete();

        return redirect()->route('user.notifications.index')
            ->with('success', 'Notification has been deleted successfully');
    }

    public function clear()
    {
        $userId = Auth::id();

        Notification::where('user_id', $userId)->delete();

        return redirect()->route('user.notifications.index')
            ->with('success', 'All notifications have been cleared successfully');
    }

    

}
