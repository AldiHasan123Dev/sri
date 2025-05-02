<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class LandingPageController extends Controller
{
    public function index()
{
    $newsList = Berita::where('stts', 'published')
                      ->orderBy('published_at', 'desc')
                      ->paginate(6); // Sesuaikan jumlah item per halaman
    return view('landing.blog', compact('newsList'));
}


public function show($slug)
{
    $news = Berita::where('slug', $slug)->where('stts', 'published')->firstOrFail();
    return view('landing.blog-details', compact('news'));
}


}
