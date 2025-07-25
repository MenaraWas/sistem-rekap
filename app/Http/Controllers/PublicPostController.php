<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;


class PublicPostController extends Controller
{
    //
    public function create()
    {
        return view('public-form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'link' => 'required|url',
            'date_posted' => 'required|date',
            'category' => 'required|in:social_media,news_portal',
            'platform' => 'required|string',
        ]);

        Post::create($validated);

        return redirect()->route('public.form')->with('success', 'Postingan berhasil dikirim!');
    }
}
