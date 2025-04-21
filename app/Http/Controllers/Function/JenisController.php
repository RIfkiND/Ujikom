<?php

namespace App\Http\Controllers\Function;

use App\Http\Controllers\Controller;
use App\Http\Requests\Function\JenisRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    //

    public function store(JenisRequest $request){
        $data = $request->validated();

        Jenis::create($data);

    return redirect()->route("dashboard")->with("success","jenis Berhasil Ditambahkan");
    }
    
    public function update(JenisRequest $request, Jenis $id){
        $data = $request->validated();

        $id->update($data);

        return redirect()->route("dashboard")->with("success","jenis Berhasil Diubah");
    }

    public function destroy(Jenis $id){
        $id->delete();

        return redirect()->route("dashboard")->with("success","jenis Berhasil Dihapus");
    }
}
