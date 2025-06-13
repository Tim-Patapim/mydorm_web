<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Paket;
use App\Models\Helpdesk;
use App\Models\Dormitizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PaketController extends Controller
{
    public function index()
    {
        // Membuat query untuk mengambil data Paket
        $query = Paket::with(['dormitizen', 'penerimaPaket', 'penyerahanPaket', 'dormitizen.kamar'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id);
            });

        // Pencarian berdasarkan input dari form
        if (request('search')) {
            $searchTerm = request('search');  // Ambil nilai pencarian

            // Menambahkan kondisi pencarian pada query
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('dormitizen', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama', 'like', '%' . $searchTerm . '%');
                })->orWhereHas('penerimaPaket', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama', 'like', '%' . $searchTerm . '%');
                })->orWhereHas('penyerahanPaket', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama', 'like', '%' . $searchTerm . '%');
                })->orWhereHas('dormitizen.kamar', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nomor', 'like', '%' . $searchTerm . '%');
                });
            });
        }
        if (request('filter_sort') == 'latest') {
            $query->orderBy('waktu_tiba', 'desc');
        } elseif (request('filter_sort') == 'oldest') {
            $query->orderBy('waktu_tiba', 'asc');
        }

        // Menyaring paket yang memenuhi kriteria pencarian
        $pakets = $query->paginate(10);

        // Mengirimkan data ke view 'paket.index'
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'dormitizen_id' => 'required|exists:dormitizen,dormitizen_id', // Validasi bahwa dormitizen_id ada dalam 
            'penerima_paket' => 'required|string|max:255',
            'waktu_tiba' => 'required|date',
            'gambar' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($request->has('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();

            $filename = time() . '_' . uniqid() . '.' . $extension;
            $path = 'images/gambarPaket/';
            $file->move($path, $filename);
        }

        try {
            // Menyimpan data paket ke database
            Paket::create([
                'dormitizen_id' => $request->input('dormitizen_id'),
                'penerima_paket' => $request->input('penerima_paket'),
                'waktu_tiba' => $request->input('waktu_tiba'),
                'gambar' => $path . $filename

            ]);

            return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Ambil paket berdasarkan ID
        $paket = Paket::findOrFail($id);

        // Kirim data paket ke view
        return view('paket.edit', compact('paket'));
    }


    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'penyerahan_paket' => 'required',
            'waktu_diambil' => 'required|date',
            'status_pengambilan' => 'required|in:belum,sudah'
        ]);

        // Cari paket berdasarkan ID dan lakukan update
        $paket = Paket::findOrFail($id);

        // Simpan perubahan
        $paket->update($request->all());

        // Redirect ke halaman paket dengan pesan sukses
        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui');
    }


    public function destroy(Paket $paket)
    {
        // Cek apakah ada gambar yang terkait dengan paket
        if ($paket->gambar) {
            // Tentukan path gambar di direktori public
            $filePath = public_path($paket->gambar);

            // Periksa apakah file ada dan kemudian hapus
            if (File::exists($filePath)) {
                File::delete($filePath);  // Menghapus gambar
            }
        }

        // Menghapus paket
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus');
    }

    public function searchDormitizen(Request $request)
    {
        $nomorKamar = $request->input('nomor_kamar');
        $gedungId = 1;

        // Validasi input nomor kamar
        if (!$nomorKamar) {
            return redirect()->back()->with('error', 'Nomor kamar harus diisi.');
        }

        try {
            // Query untuk mendapatkan kamar berdasarkan nomor kamar dan gedung_id
            $kamar = Kamar::where('nomor', $nomorKamar)
                ->where('gedung_id', 1)  // Pastikan ini sesuai dengan gedung yang Anda cari
                ->first();

            if ($kamar) {
                // Ambil data Dormitizen berdasarkan kamar_id
                $dormitizens = Dormitizen::where('kamar_id', $kamar->kamar_id)->get();


                if ($dormitizens->isNotEmpty()) {
                    return redirect()->back()->with([
                        'dormitizens' => $dormitizens,
                        'nomorKamar' => $nomorKamar,
                    ]);
                } else {
                    return redirect()->back()->with('error', 'Tidak ada Dormitizen ditemukan untuk kamar tersebut.');
                }
            } else {
                return redirect()->back()->with('error', 'Kamar tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function detailGambar($id)
    {
        // Cari paket berdasarkan ID
        $paket = Paket::findOrFail($id);

        // Tampilkan view dengan data paket
        return view('paket.detailGambar', ['gambar' => $paket->gambar]);
    }
}
