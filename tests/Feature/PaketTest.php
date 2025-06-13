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
}
