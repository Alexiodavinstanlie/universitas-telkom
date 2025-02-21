<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Periode;
use App\Models\RoleDosen;

class RoleDosenController extends Controller
{
    public function getListPeriode(){
        $tahun_ajaran = [];
        $periodes = [];
        foreach (Periode::all() as $periode) {
            if(!in_array($periode->tahun_ajaran, $tahun_ajaran)){
                $periodes[] = $periode;
                $tahun_ajaran[] = $periode->tahun_ajaran;
            }
        }
        return $periodes;
    }

    public function index(){
        $tahun_ajaran = [];
        $periodes = [];
        foreach (Periode::all() as $periode) {
            if(!in_array($periode->tahun_ajaran, $tahun_ajaran)){
                $periodes[] = $periode;
                $tahun_ajaran[] = $periode->tahun_ajaran;
            }
        }
        return view('backend.role-dosen.index', [
            'items' => RoleDosen::where('tahun_ajaran', 'like', '%' . request()->periode . '%')->latest()->get(),
            'periodes' => $periodes,
        ]);
    }

    public function create(){
        return view('backend.role-dosen.create', [
            'periodes' => $this->getListPeriode()
        ]); 
    }

    public function store(Request $request){
        $this->validate($request,[
            'kode' => 'unique:role_dosen',
        ]);
        if(!$periode = Periode::whereTahunAjaran($request->tahun_ajaran)->whereSemester($request->semester)->first()){
            return redirect()->back()->with('warning', 'Data periode yang anda pilih belum tersedia');
        }
        $data = [
            'periode_id' => $periode->id,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
        ];
        RoleDosen::create($data);
        return redirect()->route('backend.admin.role-dosen')->with('success', 'Berhasil menambahkan data');
    }

    public function edit($id){
        return view('backend.role-dosen.edit', [
            'item' => RoleDosen::find($id),
            'periodes' => $this->getListPeriode(),
        ]);
    }

    public function update(Request $request, $id){
        if(!$periode = Periode::whereTahunAjaran($request->tahun_ajaran)->whereSemester($request->semester)->first()){
            return redirect()->back()->with('warning', 'Data periode yang anda pilih belum tersedia');
        }
        $data = [
            'periode_id' => $periode->id,
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
        ];
        RoleDosen::find($id)->update($data);
        return redirect()->route('backend.admin.role-dosen')->with('success', 'Berhasil mengubah data');
    }

    public function delete($id){
        $item = RoleDosen::find($id);
        $item->delete();
        return redirect()->route('backend.admin.role-dosen')->with('success', 'Berhasil menghapus data');
    }
}
