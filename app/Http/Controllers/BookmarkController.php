<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Bookmark;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Menampilkan daftar bookmark untuk admin.
     */
    public function index()
    {
        $bookmarks = Bookmark::with('post.user') // Load relasi post dan user
            ->where('user_id', Auth::id())           // Hanya ambil bookmark milik admin yang login
            ->latest()
            ->get();

        return view('bookmarks.index', [
            'title'     => 'Your Bookmarks',
            'active'    => 'bookmarks',
            'bookmarks' => $bookmarks,
        ]);
    }

    /**
     * Menyimpan bookmark baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
        ]);

        $postId = $request->post_id;
        $userId = Auth::id();

        // Cek apakah sudah di-bookmark
        $exists = Bookmark::where('user_id', $userId)->where('post_id', $postId)->exists();
        if ($exists) {
            return back()->with('error', 'You have already bookmarked this post.');
        }

        // Simpan bookmark baru
        Bookmark::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        // Ambil postingan
        $post = Post::findOrFail($postId);

                                          // Simpan notifikasi untuk pemilik postingan
        if ($post->user_id !== $userId) { // Hindari notifikasi jika user membookmark postingannya sendiri
            Notification::create([
                'user_id'     => $post->user_id, // Pemilik postingan
                'notifier_id' => $userId,        // User yang membookmark
                'post_id'     => $postId,
                'is_read'     => false,
            ]);
        }

        return back()->with('success', 'Post bookmarked successfully.');
    }

    /**
     * Menghapus bookmark.
     */
    public function destroy($id)
    {
        $userId = Auth::id();

        $bookmark = Bookmark::where('user_id', $userId)->where('post_id', $id)->first();

        if (! $bookmark) {
            return back()->with('error', 'Bookmark not found.');
        }

        $bookmark->delete();

        return back()->with('success', 'Bookmark removed successfully.');
    }
}
