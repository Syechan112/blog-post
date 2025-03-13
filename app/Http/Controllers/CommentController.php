<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id'   => 'required|exists:posts,id',
            'content'   => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = Comment::create([
            'post_id'   => $request->post_id,
            'user_id'   => Auth::id(),
            'content'   => $request->content,
            'parent_id' => $request->parent_id,
        ]);

        // **Buat Notifikasi untuk Pemilik Post**
        $postOwnerId = $comment->post->user_id;
        if ($postOwnerId !== Auth::id()) { // Jangan notif diri sendiri
            Notification::create([
                'user_id'     => $postOwnerId,      // Pemilik postingan yang akan menerima notifikasi
                'notifier_id' => Auth::id(),        // User yang mengomentari
                'post_id'     => $comment->post_id, // Post terkait
                'is_read'     => false,             // Status belum dibaca
            ]);
        }

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->user_id) {
            return redirect()->back()->with('error', 'Anda tidak berhak menghapus komentar ini!');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }

}
