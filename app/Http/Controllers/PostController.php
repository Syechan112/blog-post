<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function myPost()
    {
        $user  = Auth::user();
        $posts = $user->posts;

        return view('posts.mypost', [
            'title'  => 'My Posts',
            'active' => 'posts',
            'posts'  => $posts,
        ]);
    }

/**
 * Display the archived posts of the authenticated user.
 */
    public function archived()
    {
        $archivedPosts = Auth::user()->posts->where('status', 'archived');

        return view('posts.archived', [
            'title'  => 'Archived Posts',
            'active' => 'posts',
            'posts'  => $archivedPosts,
        ]);
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $posts = Post::where('status', 'publish')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            })
            ->with('user', 'bookmarks')
            ->latest()
            ->paginate(10);

        return view('posts.index', [
            'title'  => 'All Posts',
            'active' => 'posts',
            'posts'  => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create', [
            'title'      => 'Create Post',
            'active'     => 'posts',
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,publish,archived',
        ]);

        $validatedData['slug']    = SlugService::createSlug(Post::class, 'slug', $request->title);
        $validatedData['user_id'] = Auth::user()->id;

        Post::create($validatedData);

        return redirect(route('my.posts'))->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.view', [
            'title'  => $post->title,
            'active' => 'posts',
            'post'   => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'title'  => 'Edit Post',
            'active' => 'posts',
            'post'   => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
            'status'      => 'required|in:draft,publish,archived',
        ]);

        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);

        $post->update($validatedData);

        return redirect(route('my.posts'))->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::user()->id) {
            abort(403);
        }

        $post->delete();

        return redirect(route('my.posts'))->with('success', 'Post has been deleted!');
    }

/**
 * Display the publisher view.
 */

    public function userPosts($id)
    {
        $user  = User::findOrFail($id);
        $posts = Post::where('user_id', $id)->latest()->get(); // Ambil semua postingan user ini

        return view('posts.publisher', [
            'title'  => 'Publisher',
            'active' => 'posts',
            'user'   => $user,
            'posts'  => $posts,
        ]);
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts    = $category->posts()->where('status', 'publish')->latest()->get();

        return view('posts.category', [
            'title'    => $category->name,
            'active'   => 'posts',
            'category' => $category,
            'posts'    => $posts,
        ]);
    }

    public function getChartData()
    {
        $posts = Post::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        return response()->json($posts);
    }

}
