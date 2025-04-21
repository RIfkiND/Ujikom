<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Requests\Function\PelangganRequest;
use App\Models\Pelanggan;
use App\Models\Tarif;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class PelangganController extends Controller
{
    public function create()
    {
        // Fetch all tarifs for the select dropdown
        $tarifs = Tarif::all();
        return view('dashboard.pelanggan.create', compact('tarifs'));
    }

    public function show($no_kontrol)
    {
        $pelanggan = Pelanggan::with(['tarif', 'pemakaian'])->where('no_kontrol', $no_kontrol)->firstOrFail();
        return view('dashboard.pelanggan.show', compact('pelanggan'));
    }

    public function store(PelangganRequest $request)
    {

            $no_kontrol = 'PLG-' . mt_rand(1000000, 9999999);
         while (Pelanggan::where('no_kontrol', '=', $no_kontrol)->exists());


        Pelanggan::create([
            'no_kontrol' => $no_kontrol,
            'name' => $request->name,
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'jenis_plg' => $request->jenis_plg,
        ]);

        return redirect()->route('dashboard.pelanggan')->with('success', 'Pelanggan created successfully!');
    }

    public function edit($no_kontrol)
    {
        $pelanggan = Pelanggan::where('no_kontrol', $no_kontrol)->firstOrFail();
        $tarifs = Tarif::all();
        return view('dashboard.pelanggan.edit', compact('pelanggan', 'tarifs'));
    }

    public function update(PelangganRequest $request, $no_kontrol)
    {
        $pelanggan = Pelanggan::where('no_kontrol', $no_kontrol)->firstOrFail();
        $pelanggan->update($request->validated());
        return redirect()->route('dashboard.pelanggan')->with('success', 'Pelanggan updated successfully!');
    }

    public function destroy($no_kontrol)
    {
        // Find the Pelanggan instance by 'no_kontrol'
        $pelanggan = Pelanggan::where('no_kontrol', $no_kontrol)->firstOrFail();

        // Delete the Pelanggan
        $pelanggan->delete();

        // Redirect to the Pelanggan list with success message
        return redirect()->route('dashboard.pelanggan')->with('success', 'Pelanggan deleted successfully!');
    }
}
