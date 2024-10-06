<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::where('user_id', auth()->id())->get();
        return view('dashboard', compact('urls'));
    }

    public function store(Request $request)
{
    $request->validate([
        'long_url' => 'required|url',
    ]);

    $longUrl = $request->long_url;

    // Automatically prepend 'https://' if missing
    if (!preg_match("~^(?:f|ht)tps?://~i", $longUrl)) {
        $longUrl = "https://" . $longUrl;
    }

    $shortUrl = Str::random(6);

    Url::create([
        'user_id' => auth()->id(),
        'long_url' => $longUrl,
        'short_url' => $shortUrl,
    ]);

    return redirect()->route('dashboard')->with('success', 'URL shortened successfully.');
}

    
    

    public function show($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->firstOrFail();
        $url->increment('click_count');
        return redirect($url->long_url);
    }
}

