<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\models\Helpdesk;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        // Get search query
        $query = $request->input('search');

        // Mengambil semua data dari model Berita
        $beritas = Berita::with(['helpdesk'])->paginate(10);

        // Mengirimkan data ke view 'berita.index'
        return view('berita.index', compact('beritas'));
    }

    public function create()
    {
        $helpdesks = Helpdesk::all();
        return view('berita.create', compact('helpdesks'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:100',
            'kategori' => 'required|string|in:Fasilitas asrama,Kegiatan/Event asrama,Tata tertib,Info penting dari ditmawa',
            'isi' => 'required|string',
            'helpdesk_id' => 'nullable|exists:helpdesk,helpdesk_id',
        ]);

        // Menyimpan berita baru
        Berita::create($request->all());

        return redirect()->route('berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita)
    {
        // Menampilkan detail berita
        return view('berita.detail', compact('berita'));
    }

    public function edit(Berita $berita)
    {
        $helpdesks = Helpdesk::all();
        return view('berita.edit', compact('berita', 'helpdesks'));
    }

    public function update(Request $request, Berita $berita)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:100',
            'kategori' => 'required|string|in:Fasilitas asrama,Kegiatan/Event asrama,Tata tertib,Info penting dari ditmawa',
            'isi' => 'required|string',
        ]);

        // Memperbarui berita
        $berita->update($request->all());

        return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita)
    {
        // Menghapus berita
        $berita->delete();

        return redirect()->route('berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
