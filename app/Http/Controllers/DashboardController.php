<?php

namespace App\Http\Controllers;

use App\Models\Dormitizen;
use App\Models\Kamar;
use App\Models\LogKeluarMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua log keluar masuk yang pending di gedung user saat ini
        $logs = LogKeluarMasuk::with(['dormitizen', 'helpdesk', 'dormitizen.kamar', 'dormitizen.kamar.gedung'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id);
            })
            ->where('status', 'pending')
            ->get();

        // Hitung total dormitizen di gedung user
        $totalDormitizen = Dormitizen::whereHas('kamar.gedung', function ($subQuery) {
            $subQuery->where('gedung_id', Auth::user()->gedung_id);
        })->count();

        // Hitung jumlah kamar yang terkunci (kosong)
        $kamarKosong = Kamar::where('status', 'terkunci')->count();

        return view('dashboard.index', compact('logs', 'totalDormitizen', 'kamarKosong'));
    }

    public function updateLog(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $log = LogKeluarMasuk::find($id);

        if (!$log) {
            return redirect()->back()->with('error', 'Data log tidak ditemukan.');
        }

        $log->status = $request->input('status');
        $log->helpdesk_id = Auth::user()->helpdesk_id;
        $log->save();

        return redirect()->route('logskeluarmasuk.index')->with('success', 'Data log berhasil diperbarui.');
    }
}
