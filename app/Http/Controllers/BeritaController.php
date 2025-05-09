<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.berita', compact('beritas'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $request)
    {
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita_gambar', 'public');
        }

        $videoPath = null;
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('berita_video', 'public');
        }
        Berita::create([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'stts' => auth()->user()->role === 'super_admin' ? 'published' : 'private',
            'penulis' => $request->penulis,
            'gambar' => $gambarPath,
            'video' => $videoPath,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function publish($id)
    {
        // Ambil berita berdasarkan ID
        $berita = Berita::findOrFail($id);
        
        // Ubah status menjadi 'published'
        $berita->stts = 'published';
        $berita->published_at = now();
        
        // // Set tanggal publikasi jika belum ada
        // if (!$berita->published_at) {
        //     $berita->published_at = now();
        // }

        // Simpan perubahan ke database
        $berita->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Berita berhasil dipublikasikan!');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.show', compact('berita'));
    }

    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return response()->json($berita);
    }
    

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita_gambar', 'public');
            $berita->gambar = $gambarPath;
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('berita_video', 'public');
            $berita->video = $videoPath;
        }
    

        $berita->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
            'kategori' => $request->kategori,
            'penulis' => $request->penulis,
            'gambar' => $berita->gambar,
            'video' => $berita->video,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
