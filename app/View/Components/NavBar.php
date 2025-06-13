<?php

namespace App\View\Components;

use App\Models\LogKeluarMasuk;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NavBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $totalRequest;
    public $data;

    public function __construct()
    {
        $query = LogKeluarMasuk::with(['dormitizen', 'helpdesk', 'dormitizen.kamar', 'dormitizen.kamar.gedung'])
            ->whereHas('dormitizen.kamar.gedung', function ($subQuery) {
                $subQuery->where('gedung_id', Auth::user()->gedung_id);
            });

        $this->data = $query->where('status', 'pending')->get();
        $this->totalRequest = count($this->data);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
