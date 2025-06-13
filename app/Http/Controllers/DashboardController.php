<?php

namespace App\Http\Controllers;

use App\Models\Dormitizen;
use App\Models\Kamar;
use App\Models\LogKeluarMasuk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private $ApiBaseURL = "http://localhost:3000/api";

    function index()
    {
        // Query untuk mengambil request keluar masuk yang pending
        $query = LogKeluarMasuk::with(['dormitizen', 'helpdesk', 'dormitizen.kamar', 'dormitizen.kamar.gedung'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id);
            })
            ->where('status', 'pending');
        $logs = $query->get();

        // Query untuk mengambil total dormitizen gedung ini
        $query = Dormitizen::with(['kamar', 'kamar.gedung'])->whereHas('kamar.gedung', function ($subQuery) {
            $subQuery->where('gedung_id', Auth::user()->gedung_id);
        });
        $totalDormitizen = count($query->get());
        $kamarKosong = count(Kamar::query()->where('status', 'terkunci')->get());

        return view('dashboard.index', compact('logs', 'totalDormitizen', 'kamarKosong'));
    }

    public function updateLog($id)
    {
        $logData = LogKeluarMasuk::query()->find($id);
        $putLogAPI = "{$this->ApiBaseURL}/update-log/{$id}";
        try {
            $response = Http::put($putLogAPI, [
                "waktu" => $logData->waktu,
                "aktivitas" => $logData->aktivitas,
                "status" => request('status'),
                "dormitizen_id" => $logData->dormitizen_id,
                "senior_resident_id" => null,
                "helpdesk_id" => Auth::user()->helpdesk_id,
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
}
