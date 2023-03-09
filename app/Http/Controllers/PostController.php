<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('adminAccess')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->where('visibility', 0)->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $validated_data = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'visibility' => ['required', 'integer', 'between:0,2']
        ]);

        $validated_data['slug'] = Str::slug($validated_data['title']) . '-' . Str::random(4);
        $validated_data['user_id'] = Auth::user()->id;

        $post = Post::create($validated_data);
        return redirect()->route('posts.show', $post)->with([
            'success' => 'Note created successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->visibility === 2 && $post->user->id !== Auth::user()->id) {
            abort(404);
        }
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user->id !== Auth::user()->id) {
            return redirect()->route('posts.show', $post);
        }
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        if ($post->user->id !== Auth::user()->id) {
            return redirect()->route('posts.show', $post);
        }
        $validated_data = $request->validate([
            'title' => ['required', 'max:255'],
            'content' => ['required'],
            'visibility' => ['required', 'integer', 'between:0,2']
        ]);
        if ($post->title != $validated_data['title']) {
            $validated_data['slug'] = Str::slug($validated_data['title']) . '-' . Str::random(4);
        }

        $post->update($validated_data);
        return redirect()->route('posts.show', $post)->with([
            'success' => 'Note updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user->id !== Auth::user()->id) {
            return redirect()->route('posts.show', $post);
        }
        $post->delete();
        return redirect()->route('personal')->with([
            'success' => 'Note deleted successfully.'
        ]);
    }

    public function showPersonal()
    {
        return view('posts.personal', [
            'posts' => Auth::user()->posts,
        ]);
    }
}
