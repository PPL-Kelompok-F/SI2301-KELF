<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('user')->latest()->get();
        return view('forum.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        ForumPost::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Pertanyaan berhasil diposting!');
    }

    public function show($id)
    {
        $post = ForumPost::with(['user', 'replies.user'])->findOrFail($id);
        return view('forum.show', compact('post'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate(['content' => 'required|string']);

        ForumReply::create([
            'forum_post_id' => $id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }
}