<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Requests\Function\TarifRequest;
use App\Models\Jenis;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{

    public function create()
    {
        // $jenis = Jenis::all();
        return view('Dashboard.tarifs.create');
        // return view('Dashboard.tarifs.create', compact('jenis'));
    }

        public function edit(Tarif $id){
            // $jenis = Jenis::all();
            return view('Dashboard.tarifs.edit', [
                'tarif' => $id,
                // 'jenis' => $jenis
            ]);
        }



    public function store(TarifRequest $request)
    {
        Tarif::create($request->validated());
        return redirect()->route('dashboard.tarif')->with('success', 'Tarif created successfully.');
    }

    public function update(TarifRequest $request, Tarif $id)
    {
       $id->update($request->validated());
        return redirect()->route('dashboard.tarif')->with('success', 'Tarif updated successfully.');
    }

    public function destroy(Tarif $id){
        $id->delete();
        return redirect()->back()->with("success"," Tarif berhasil dihapus");
    }
}

