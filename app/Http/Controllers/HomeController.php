<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // public function index(Request $request)
    // {
    //     $pelanggan = null;
    //     $pemakaians = collect();

    //     if ($request->has('search')) {
    //         $pelanggan = Pelanggan::with('tarif')->where('no_kontrol', $request->search)->first();

    //         if ($pelanggan) {
    //             $pemakaians = Pemakaian::where('no_kontrol', $pelanggan->no_kontrol)->get();
    //         }
    //     }

    //     return view('welcome', compact('pelanggan', 'pemakaians'));
    // }
    public function index(Request $request)
    {
        $pelanggan = null;
        $pemakaians = collect();

        if ($request->has('search')) {
         
            $pelanggan = Pelanggan::with('tarif')->where('no_kontrol', $request->search)->first();

            if ($pelanggan) {

                $pemakaiansQuery = Pemakaian::where('no_kontrol', $pelanggan->no_kontrol);


                if ($request->filled('status') && in_array($request->status, ['lunas', 'belum_bayar'])) {
                    $pemakaiansQuery->where('status', $request->status);
                }


                if ($request->filled('start_date') && $request->filled('end_date')) {
                    $pemakaiansQuery->whereBetween('created_at', [$request->start_date, $request->end_date]);
                }


                if ($request->filled('sort') && in_array($request->sort, ['latest', 'oldest'])) {
                    $order = $request->sort === 'latest' ? 'desc' : 'asc';
                    $pemakaiansQuery->orderBy('created_at', $order);
                }


                $pemakaians = $pemakaiansQuery->get();
            }
        }

        return view('welcome', compact('pelanggan', 'pemakaians'));
    }

}
