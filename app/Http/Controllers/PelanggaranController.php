<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelanggaran::with(['dormitizen'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id); // Mengambil hanya gedung dengan id user login
            });

        if (request('search')) {
            $searchTerm = request('search');
            $query->whereHas('dormitizen', function ($subQuery) use ($searchTerm) {
                $subQuery->where('nama', 'like', '%' . $searchTerm . '%');
            });
            $pelanggarans = $query->selectRaw('dormitizen_id, count(*) as total_pelanggaran')
                ->groupBy('dormitizen_id');
        } else {
            // Query pelanggarans deengan pagination
            $pelanggarans = $query // Eager load relationships
                ->selectRaw('dormitizen_id, count(*) as total_pelanggaran')
                ->groupBy('dormitizen_id'); // Pagination dengan total results
        }

        if (request('filter_sort') == 'most') {
            $pelanggarans->orderBy('total_pelanggaran', 'desc');
        } elseif (request('filter_sort') == 'least') {
            $pelanggarans->orderBy('total_pelanggaran', 'asc');
        }

        $pelanggarans = $query->paginate(10);

        // Mengirimkan data ke view 'pelanggaran.index'
        return view('pelanggaran.index', compact('pelanggarans'));
    }
}
