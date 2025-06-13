<?php

namespace App\Http\Controllers;

use App\Models\Dormitizen;
use Illuminate\Support\Facades\Auth;

class DormitizenController extends Controller
{
    function index()
    {
        $query = Dormitizen::with(['kamar'])
            ->whereHas('kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id); // Mengambil hanya gedung dengan id user login
            });

        if (request('search')) {
            $searchTerm = request('search');
            $query = Dormitizen::where('nama', 'like', '%' . $searchTerm . '%')
                ->orWhere('agama', 'like', '%' . $searchTerm . '%')
                ->orWhere('prodi', 'like', '%' . $searchTerm . '%')
                ->orWhere('no_hp', 'like', '%' . $searchTerm . '%')
                ->orWhere('no_hp_ortu', 'like', '%' . $searchTerm . '%')
                ->orWhere('alamat_ortu', 'like', '%' . $searchTerm . '%');
            $data = $query->paginate(10);
        } else {
            $data = $query->paginate(10);
        }

        return view('dormitizen.index', compact('data'));
    }
}
