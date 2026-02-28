<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Platform;
use Illuminate\Http\Request;


class PublicPostController extends Controller
{
    public function create()
    {
        $platforms = Platform::orderBy('name')->get();

        $platformJson = $platforms->filter(function ($p) {
            return $p->domain;
        })->map(function ($p) {
            return [
                'code' => $p->code,
                'domain' => $p->domain,
                'category' => $p->category,
            ];
        })->values();

        return view('public-form', compact('platforms', 'platformJson'));
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
