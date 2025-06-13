<?php

namespace App\Http\Controllers;

use App\Models\Dormitizen;
use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\LogKeluarMasuk;
use App\Models\Paket;
use App\Models\Pelanggaran;

class KamarController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model Kamar
        $kamars = Kamar::all();

        // Mengirimkan data ke view 'kamar.index'
        return view('kamar.kamar', compact('kamars'));
    }

    public function detail($id)
    {
        // Mengambil semua data dari model Paket
        $dormitizens = Dormitizen::where('kamar_id', $id)->get();
        $logsData = [];
        foreach ($dormitizens as $d) {
            $logsData[] = LogKeluarMasuk::where('dormitizen_id', $d->dormitizen_id)->get();
        }
        $pelanggaransData = [];
        foreach ($dormitizens as $d) {
            $pelanggaransData[] = Pelanggaran::where('dormitizen_id', $d->dormitizen_id)->get();
        }

        $fromPelanggaran = request('from') == 'pelanggaran';

        // Mengirimkan data ke view 'kamar.index'
        return view('kamar.detailKamar', compact('dormitizens', 'logsData', 'pelanggaransData', 'fromPelanggaran'));
    }
}
