<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemakaian;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PembayaranController extends Controller
{
    public function create($pemakaian_id)
{
    $pemakaian = Pemakaian::with('pelanggan')->findOrFail($pemakaian_id);

    // Fetch tunggakan (unpaid months) for the same no_kontrol
    $tunggakan = Pemakaian::where('no_kontrol', $pemakaian->no_kontrol)
        ->where('status', 'belum_bayar')
        ->where(function ($query) use ($pemakaian) {
            $query->where('tahun', '<', $pemakaian->tahun)
                ->orWhere(function ($query) use ($pemakaian) {
                    $query->where('tahun', $pemakaian->tahun)
                        ->where('bulan', '<', $pemakaian->bulan);
                });
        })
        ->orderBy('tahun', 'asc')
        ->orderBy('bulan', 'asc')
        ->get();

    return view('Dashboard.pembayaran.create', compact('pemakaian', 'tunggakan'));
}

public function store(Request $request)
{
    DB::transaction(function () use ($request) {
        $request->validate([
            'pemakaian_ids' => 'array', // For tunggakan
            'pemakaian_ids.*' => 'exists:pemakaians,id',
            'pemakaian_id' => 'nullable|exists:pemakaians,id', // For current month
            'jumlah_bayar' => 'nullable|numeric|min:1',
            'tanggal_bayar' => 'required|date',
        ]);

        // Handle tunggakan payments
        if ($request->has('pemakaian_ids') && is_array($request->pemakaian_ids)) {
            foreach ($request->pemakaian_ids as $id) {
                $pemakaian = Pemakaian::findOrFail($id);
                $pemakaian->update([
                    'status' => 'lunas',
                    'tanggal_bayar' => $request->tanggal_bayar,
                ]);
            }
        }
        // Handle current month payment
        if ($request->has('pemakaian_id')) {
            $pemakaian = Pemakaian::findOrFail($request->pemakaian_id);

            if ($request->jumlah_bayar < $pemakaian->total_bayar) {
                throw new \Exception('Jumlah bayar tidak mencukupi total tagihan.');
            }

            $pemakaian->update([
                'status' => 'lunas',
                'tanggal_bayar' => $request->tanggal_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);
        }
    });

    return redirect()->route('dashboard.pemakaian')->with('success', 'Pembayaran berhasil disimpan!');
}
    public function generateLaporan(Request $request)
    {
        // Get input values
        $id = $request->input('id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('status');


        if ($id) {

            $pembayaran = Pemakaian::with('pelanggan')->find($id);

            if (!$pembayaran) {
                return redirect()->route('dashboard.pemakaian')->with('error', 'Pemakaian not found!');
            }
        } else {

            $query = Pemakaian::with('pelanggan');


            if ($startDate && $endDate) {
                $query->whereBetween('tanggal_bayar', [$startDate, $endDate]);
            }


            if ($status) {
                $query->where('status', $status);
            }


            $pembayaran = $query->orderBy('tanggal_bayar', 'desc')->get();
        }


        $pdf = pdf::loadView('laporan.pembayaran', compact('pembayaran'));

        return $pdf->download('laporan_pembayaran.pdf');
    }

    public function generatePdf($id)
    {
        $pemakaian = Pemakaian::with('pelanggan.tarif')->findOrFail($id);

        $pdf = Pdf::loadView('laporan.struct', compact('pemakaian'));
        return $pdf->download("pemakaian_{$pemakaian->id}.pdf");
    }
}
