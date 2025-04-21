<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Requests\Function\PemakaianRequest;
use App\Models\Pelanggan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    public function create()
    {
        $pelanggans = Pelanggan::all();

        // Retrieve the last meter_akhir for each pelanggan
        $lastMeterAkhir = [];
        foreach ($pelanggans as $pelanggan) {
            $lastPemakaian = Pemakaian::where('no_kontrol', $pelanggan->no_kontrol)
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'desc')
                ->first();

            $lastMeterAkhir[$pelanggan->no_kontrol] = $lastPemakaian ? $lastPemakaian->meter_akhir : null;
        }

        return view('Dashboard.pemakaian.create', compact('pelanggans', 'lastMeterAkhir'));
    }

    public function store(PemakaianRequest $request)
    {

        $existingPemakaian = Pemakaian::where('no_kontrol', $request->no_kontrol)
        ->where('bulan', $request->bulan)
        ->where('tahun', $request->tahun)
        ->first();

    if ($existingPemakaian) {
        return redirect()->back()->withErrors([
            'error' => 'Pemakaian untuk bulan dan tahun ini sudah ada untuk No Kontrol tersebut.'
        ])->withInput();
    }

    // Check if the previous month exists
    $previousMonth = Pemakaian::where('no_kontrol', $request->no_kontrol)
        ->where('bulan', $request->bulan - 1)
        ->where('tahun', $request->tahun)
        ->first();

    if (!$previousMonth && $request->bulan != 1) {
        return redirect()->back()->withErrors([
            'error' => 'Pemakaian untuk bulan sebelumnya belum diinput. Harap input bulan sebelumnya terlebih dahulu.'
        ])->withInput();
    }


    $pelanggan = Pelanggan::where('no_kontrol', $request->no_kontrol)->firstOrFail();
    $tarif = $pelanggan->tarif;

    $jumlah_pakai = $request->meter_akhir - $request->meter_awal;
    $biaya_beban = (int) $tarif->biaya_beban;
    $tarif_kwh = (int) $tarif->tarif_kwh;

    $biaya_pemakaian = $jumlah_pakai * $tarif_kwh;
    $total_bayar = $biaya_beban + $biaya_pemakaian;

    Pemakaian::create([
        'no_kontrol' => $request->no_kontrol,
        'tahun' => $request->tahun,
        'bulan' => $request->bulan,
        'meter_awal' => $request->meter_awal,
        'meter_akhir' => $request->meter_akhir,
        'jumlah_pakai' => $jumlah_pakai,
        'biaya_beban_pemakaian' => $biaya_beban,
        'biaya_pemakaian' => $biaya_pemakaian,
        'total_bayar' => $total_bayar,
    ]);

    return redirect()->route('dashboard.pemakaian')->with('success', 'Pemakaian berhasil ditambahkan!');
}


    public function edit($id)
    {
        $pemakaian = Pemakaian::findOrFail($id);
        $pelanggans = Pelanggan::all();

        // Get the last month's meter_akhir for the same no_kontrol
        $lastPemakaian = Pemakaian::where('no_kontrol', $pemakaian->no_kontrol)
            ->where('id', '<', $pemakaian->id)
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $lastMeterAkhir = $lastPemakaian ? $lastPemakaian->meter_akhir : null;

        return view('Dashboard.pemakaian.edit', compact('pemakaian', 'pelanggans', 'lastMeterAkhir'));
    }
    public function update(PemakaianRequest $request, $id)
    {
        $pemakaian = Pemakaian::findOrFail($id);
        $pelanggan = Pelanggan::where('no_kontrol', $request->no_kontrol)->firstOrFail();
        $tarif = $pelanggan->tarif;

        $jumlah_pakai = $request->meter_akhir - $request->meter_awal;
        $biaya_beban = (int) $tarif->biaya_beban;
        $tarif_kwh = (int) $tarif->tarif_kwh;

        $biaya_pemakaian = $jumlah_pakai * $tarif_kwh;
        $total_bayar = $biaya_beban + $biaya_pemakaian;

        $pemakaian->update([
            'no_kontrol' => $request->no_kontrol,
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'meter_awal' => $request->meter_awal,
            'meter_akhir' => $request->meter_akhir,
            'jumlah_pakai' => $jumlah_pakai,
            'biaya_beban_pemakaian' => $biaya_beban,
            'biaya_pemakaian' => $biaya_pemakaian,
            'total_bayar' => $total_bayar,
        ]);

        return redirect()->route('dashboard.pemakaian')->with('success', 'Pemakaian berhasil diupdate!');
    }

    public function show($id)
    {
        $pemakaian = Pemakaian::with('pelanggan')->findOrFail($id);
        return view('dashboard.pemakaian.show', compact('pemakaian'));
    }

    public function destroy($id)
    {
        Pemakaian::findOrFail($id)->delete();
        return redirect()->route('dashboard.pemakaian')->with('success', 'Pemakaian berhasil dihapus!');
    }
}
