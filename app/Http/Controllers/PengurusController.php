<?php

namespace App\Http\Controllers;

use App\Models\Pengurus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusController extends Controller
{
    // Menampilkan daftar pengurus
    public function index()
    {
        $pengurus = Pengurus::all();
        return view('admin.pengurus', compact('pengurus'));
    }

    // Mengambil data pengurus untuk proses edit
    public function edit($id)
    {
        $pengurus = Pengurus::find($id);
        if (!$pengurus) {
            return response()->json(['error' => 'Pengurus tidak ditemukan'], 404);
        }

        return response()->json($pengurus);
    }

    // Menghapus data pengurus
    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        // Hapus file foto dari storage jika ada
        if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
            Storage::disk('public')->delete($pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->back()->with('success', 'Data pengurus berhasil dihapus.');
    }

    // Memperbarui data pengurus
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required',
            'divisi' => 'required',
        ]);

        $pengurus = Pengurus::findOrFail($id);

        $pengurus->fill([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'divisi' => $request->divisi,
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
                Storage::disk('public')->delete($pengurus->foto);
            }

            // Upload foto baru
            $fotoPath = $request->file('foto')->store('foto_pengurus', 'public');
            $pengurus->foto = $fotoPath;
        }

        $pengurus->save();

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil diperbarui.');
    }

    // Menyimpan data pengurus baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'alamat' => 'required|string',
            'nomor_telepon' => 'required',
            'divisi' => 'required',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pengurus', 'public');
        }

        Pengurus::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'divisi' => $request->divisi,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan.');
    }
}
