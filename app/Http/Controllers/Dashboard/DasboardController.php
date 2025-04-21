<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Pemakaian;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
class DasboardController extends Controller
{
    public function index(){
        $users = User::paginate(10);
        $totalUsers = User::count();
        $totalPelanggan = Pelanggan::count();
        $totalPemakaian = Pemakaian::count();
        return view("dashboard", compact('totalUsers', 'totalPelanggan', 'totalPemakaian' ,'users'));
    }
    public function tarif(){
        $tarifs = Tarif::paginate(10);
        return view('Dashboard.tarifs.index', [
            'tarifs' => $tarifs
        ]);
    }

    public function Pelanggan(Request $request){
        $search = $request->input('search');

        $pelanggans = Pelanggan::latest()->with('tarif')
        ->whereAny(['name','no_kontrol' ], 'LIKE' , "%$search")
        ->paginate(10);

        return view('Dashboard.pelanggan.index', [
            'pelanggans' => $pelanggans
        ]);
    }
    public function pemakaian(Request $request){
        $search = $request->input('search');

        $pemakaians= Pemakaian::latest()->with('pelanggan')
        ->whereAny(['tahun','bulan','no_kontrol'], 'LIKE' , "%$search")
        ->orWhereHas('pelanggan',   function($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
        })
        ->paginate(10);
        return view('Dashboard.pemakaian.index', [
            'pemakaians' => $pemakaians
        ]);
    }
    public function history(Request $request)
    {
        $search = $request->input('search');

        $query = Pemakaian::latest()->with('pelanggan');

        if ($search) {
            $query->whereAny(['tahun', 'bulan', 'no_kontrol'], 'LIKE', "%$search%")
            ->orWhereHas('pelanggan',   function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            });

        }
        if ($request->has('status') && in_array($request->status, ['lunas', 'belum_bayar'])) {
            $query->where('status', $request->status);
        }


        if ($request->filled('start_date') && $request->filled('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal_bayar', [$startDate, $endDate]);
        }

        $pemakaians = $query->paginate(10)->appends($request->all());

        return view('Dashboard.history.index', [
            'pemakaians' => $pemakaians,
        ]);
    }

}
