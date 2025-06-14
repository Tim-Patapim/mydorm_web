<?php

namespace Tests\Feature;

use App\Http\Controllers\PaketController;
use App\Models\Helpdesk;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PaketTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    /** @test */
    public function test_search_dormitizen_found()
    {
        $paket = new PaketController;
        $req = new Request();

        $req->merge([
            'nomor_kamar' => '101'
        ]);

        $response = $paket->searchDormitizen($req);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('dormitizens'));
        $this->assertEquals('101', session('nomorKamar'));
    }
    /** @test */
    public function test_search_dormitizen_missing_room_number()
    {
        $controller = new PaketController;
        $request = new Request();

        // Tidak ada input nomor_kamar
        $response = $controller->searchDormitizen($request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Nomor kamar harus diisi.', session('error'));
    }

    /** @test */
    public function test_search_dormitizen_room_not_found()
    {
        $controller = new PaketController;
        $request = new Request();

        $request->merge([
            'nomor_kamar' => '911' // Nomor kamar yang tidak ada di database
        ]);

        $response = $controller->searchDormitizen($request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertTrue(session()->has('error'));
        $this->assertEquals('Kamar tidak ditemukan.', session('error'));
    }
}
