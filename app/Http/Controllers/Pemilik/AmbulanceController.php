<?php

namespace App\Http\Controllers\pemilik;

use App\Http\Controllers\Controller;
use App\Models\Ambulance;
use App\Models\PemilikAmbulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AmbulanceController extends Controller
{
    function tambah()
    {
        $data['web'] = [
            'title' => 'Tambah Ambulance',
            'page' => 'ambulance'
        ];
        return view('pemilik.form-ambulance', $data);
    }

    function simpan(Request $request)
    {
        $request->validate([
            'keterangan' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'status' => 'required',
        ]);

        try {
            $data = $request->all();
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $file_name = 'img_' . date('YmdHis') . '_' . rand(1000, 9999) . '.' . $file->getClientOriginalExtension();
                try {
                    $file->storeAs('ambulance', $file_name, 'public');
                    $data['foto'] = 'storage/ambulance/' . $file_name;
                } catch (\Exception $e) {
                    return redirect()->back()->withInput()->with('error', 'Gagal mengupload foto');
                }
            }

            $pemilik = PemilikAmbulance::where('id_user', Auth::user()->id)->first();
            $data['id_pemilik'] = $pemilik->id;
            Ambulance::updateOrCreate(['id' => $request->id], $data);
            return redirect('/pemilik/dashboard')->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
