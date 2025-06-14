<?php

namespace App\Http\Controllers;

use App\Models\LogKeluarMasuk;
use App\Models\Dormitizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index()
    {
        $query = LogKeluarMasuk::with(['dormitizen', 'helpdesk', 'dormitizen.kamar', 'dormitizen.kamar.gedung'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id); 
            }); 

        if (request('filter_sort') == 'latest') {
            $query->orderBy('waktu', 'desc');
        } elseif (request('filter_sort') == 'oldest') {
            $query->orderBy('waktu', 'asc');
        }

        if (request('search')) {
            $searchTerm = request('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('dormitizen', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('helpdesk', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nama', 'like', '%' . $searchTerm . '%');
                })
                ->orWhereHas('dormitizen.kamar', function ($subQuery) use ($searchTerm) {
                    $subQuery->where('nomor', 'like', '%' . $searchTerm . '%');
                })
                ->orWhere('waktu', 'like', '%' . $searchTerm . '%')
                ->orWhere('status', 'like', '%' . $searchTerm . '%')
                ->orWhere('aktivitas', 'like', '%' . $searchTerm . '%');
            });
        }

        $logsData = $query->paginate(10);
        return view('logskeluarmasuk.index', compact('logsData'));
    }

    public function create()
    {
        return view('logskeluarmasuk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'waktu' => 'required|date',
            'aktivitas' => 'required|string',
            'dormitizen_id' => 'required|exists:dormitizens,id',
            'pjPenerima' => 'required|exists:helpdesks,id',
        ]);

        LogKeluarMasuk::create([
            'waktu' => $validated['waktu'],
            'aktivitas' => $validated['aktivitas'],
            'status' => 'diterima',
            'dormitizen_id' => $validated['dormitizen_id'],
            'senior_resident_id' => null,
            'helpdesk_id' => $validated['pjPenerima'],
        ]);

        return redirect()->route('logskeluarmasuk.index')->with('success', 'Data log telah berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $logData = LogKeluarMasuk::findOrFail($id);
        return view('logskeluarmasuk.edit', compact('logData'));
    }

    public function update(Request $request, $id)
    {
        $log = LogKeluarMasuk::findOrFail($id);

        $validated = $request->validate([
            'waktu' => 'required|date',
            'aktivitas' => 'required|string',
            'status' => 'required|string',
            'dormitizen_id' => 'required|exists:dormitizens,id',
            'pjPenerima' => 'required|exists:helpdesks,id',
        ]);

        $log->update([
            'waktu' => $validated['waktu'],
            'aktivitas' => $validated['aktivitas'],
            'status' => $validated['status'],
            'dormitizen_id' => $validated['dormitizen_id'],
            'senior_resident_id' => null,
            'helpdesk_id' => $validated['pjPenerima'],
        ]);

        return redirect()->route('logskeluarmasuk.index')->with('success', 'Data log telah berhasil diubah!');
    }

    public function destroy($id)
    {
        $log = LogKeluarMasuk::findOrFail($id);
        $log->delete();

        return redirect()->route('logskeluarmasuk.index')->with('success', 'Log berhasil dihapus!');
    }

    public function searchDormitizen(Request $request)
    {
        $nomorKamar = $request->input('nomor_kamar');

        if (!$nomorKamar) {
            return redirect()->back()->with('error', 'Nomor kamar harus diisi.');
        }

        $kodeGedung = Auth::user()->gedung->kode;

        $dormitizens = Dormitizen::whereHas('kamar.gedung', function ($q) use ($kodeGedung) {
                $q->where('kode', $kodeGedung);
            })
            ->whereHas('kamar', function ($q) use ($nomorKamar) {
                $q->where('nomor', $nomorKamar);
            })
            ->get();

        if ($dormitizens->isEmpty()) {
            return redirect()->back()->with('error', 'Nomor kamar tidak ditemukan.');
        }

        return redirect()->back()->with([
            'dormitizens' => $dormitizens,
            'nomorKamar' => $nomorKamar,
        ]);
    }
}
