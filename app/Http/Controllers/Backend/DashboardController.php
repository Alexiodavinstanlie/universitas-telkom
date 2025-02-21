<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Multipart;
use App\Models\User;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\CurrentSemester;
use App\Helpers\MultipartHelper;
use App\Models\TahunAjaran;

class DashboardController extends Controller
{
    public function dashboard()
    {
        session(['role_dosen' => null]);
        return view('backend.dashboard', [
            'current_semester' => CurrentSemester::find(1),
            'list_tahun_ajaran' => TahunAjaran::all()
        ]);
    }
    public function updateTahunAjaran(Request $request)
    {
        $tahun_ajaran = TahunAjaran::find($request->tahun_ajaran);
        if ($tahun_ajaran->is_active == 1) {
            $is_active = 0;
        } else {
            $is_active = 1;
        }
        $tahun_ajaran->update([
            'is_active' => $is_active
        ]);
    }
    public function indexProfile()
    {
        session(['role_dosen' => null]);
        return view('backend.profile');
    }

    public function UpdateProfile(Request $request)
    {
        if (auth()->user()->role_id == IS_ADMIN) {
            $item = Admin::whereUserId(auth()->id())->first();
        } elseif (auth()->user()->role_id == IS_DOSEN) {
            $item = Dosen::whereUserId(auth()->id())->first();
        } elseif (auth()->user()->role_id == IS_MAHASISWA) {
            $item = Mahasiswa::whereUserId(auth()->id())->first();
        }
        $data = $request->all();
        $data['password'] = $request->password ? bcrypt($request->password) : $item->password;
        $data['foto'] = $request->foto ? MultipartHelper::userUpload($request->foto) : $item->foto;
        $item->update($data);
        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }
}
