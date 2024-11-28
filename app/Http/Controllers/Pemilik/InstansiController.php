<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\PemilikAmbulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstansiController extends Controller
{
    function index()
    {
        $data['web'] = [
            'title' => 'Data Pemilik Ambulance',
            'page' => 'instansi'
        ];

        $data['pemilik'] = PemilikAmbulance::where('id_user', Auth::user()->id)->first();
        return view('pemilik.instansi', $data);
    }

    function simpan(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required',
            'nomor_hp' => 'required',
            'deskripsi' => 'required',
            'alamat' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        try {
            $data = $request->all();
            PemilikAmbulance::updateOrCreate(['id_user' => Auth::user()->id], $data);
            return redirect('/pemilik/dashboard')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
