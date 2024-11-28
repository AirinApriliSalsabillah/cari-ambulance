<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\PemilikAmbulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index()
    {
        $data['web'] = [
            'title' => 'Dashboard',
            'page' => 'dashboard'
        ];

        $data['pemilik'] = PemilikAmbulance::where('id_user', Auth::user()->id)->first();
        if ($data['pemilik'] != null) {
            $data['ambulance'] = Ambulance::where('id_pemilik', $data['pemilik']->id)->get();
        }

        return view('pemilik.dashboard', $data);
    }
}
