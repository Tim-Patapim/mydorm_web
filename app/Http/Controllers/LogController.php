<?php

namespace App\Http\Controllers;

use App\Models\LogKeluarMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LogController extends Controller
{
    private $ApiBaseURL = "http://localhost:3000/api";

    public function index()
    {
        $query = LogKeluarMasuk::with(['dormitizen', 'helpdesk', 'dormitizen.kamar', 'dormitizen.kamar.gedung'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id); 
            }); 

        // Handle sorting
        if (request('filter_sort') == 'latest') {
            $query->orderBy('waktu', 'desc');
        } elseif (request('filter_sort') == 'oldest') {
            $query->orderBy('waktu', 'asc');
        }

        // Handle search
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

    public function store(Request $request)
    {
        $postLogAPI = "{$this->ApiBaseURL}/add-log";

        try {
            $response = Http::post($postLogAPI, [
                "waktu" => $request->waktu,
                "aktivitas" => $request->aktivitas,
                "status" => "diterima",
                "dormitizen_id" => $request->dormitizen_id,
                "senior_resident_id" => null,
                "helpdesk_id" => $request->pjPenerima,
            ]);

            if ($response->successful()) {
                return redirect()->route('logskeluarmasuk.index')->with('success', 'Data log telah berhasil ditambahkan!');
            } else {
                return redirect()->route('logskeluarmasuk.create')->with('error', 'Semua field harus terisi!');
            }
        } catch (\Exception $e) {
            return redirect()->route('logskeluarmasuk.create')->with('error', 'Gagal menghubungi API!');
        }
    }

    public function create()
    {
        return view('logskeluarmasuk.create');
    }

    public function edit($id)
    {
        $getLogAPIbyID = "{$this->ApiBaseURL}/get-log/{$id}";
        try {
            $response = Http::get($getLogAPIbyID);
            if ($response->successful()) {
                $logData = $response->json()['data'][0];
                return view('logsKeluarMasuk.edit', compact('logData'));
            } else {
                return redirect()->route('logskeluarmasuk.index')->with('error', 'Failed to fetch data from node js!');
            }
        } catch (\Exception $e) {
            return redirect()->route('logskeluarmasuk.index')->with('error', 'Gagal menghubungi API.');
        }
    }

    public function searchDormitizen(Request $request)
    {
        $nomorKamar = $request->input('nomor_kamar');

        // Validasi nomor kamar
        if (!$nomorKamar) {
            return redirect()->back()->with('error', 'Nomor kamar harus diisi.');
        }

        $kodeGedung = Auth::user()->gedung->kode;
        $getLogApi = "{$this->ApiBaseURL}/get-dormitizens/{$kodeGedung}/{$nomorKamar}";

        try {
            $response = Http::get($getLogApi);
            if ($response->ok() && (count($response->json()['data']) != 0)) {
                $dormitizens = $response->json()['data'];
                return redirect()->back()->with([
                    'dormitizens' => $dormitizens,
                    'nomorKamar' => $nomorKamar,
                ]);
            } else {
                return redirect()->back()->with('error', 'Nomor kamar tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $putLogAPI = "{$this->ApiBaseURL}/update-log/{$id}";
        try {
            $response = Http::put($putLogAPI, [
                "waktu" => $request->waktu,
                "aktivitas" => $request->aktivitas,
                "status" => $request->status,
                "dormitizen_id" => $request->dormitizen_id,
                "senior_resident_id" => null,
                "helpdesk_id" => $request->pjPenerima,
            ]);
            if ($response->successful()) {
                return redirect()->route('logskeluarmasuk.index')->with('success', 'Data log telah berhasil diubah!');
            } else {
                return redirect()->back()->with('error', 'Semua field harus terisi!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghubungi API!');
        }
    }

    public function destroy($id)
    {
        $deleteLogApi = "{$this->ApiBaseURL}/delete-log/{$id}";

        try {
            $response = Http::delete($deleteLogApi);

            if ($response->successful()) {
                return redirect()->route('logskeluarmasuk.index')->with('success', 'log berhasil dihapus!');
            } else {
                return back()->with('error', 'Gagal menghapus log.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghubungi API.');
        }
    }
}
