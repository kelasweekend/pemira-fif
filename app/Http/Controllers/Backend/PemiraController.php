<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Calon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PemiraController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-view', ['only' => ['index', 'edit']]);
        $this->middleware('permission:calon-create', ['only' => ['store', 'create']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('pemira.calon');
    }

    public function create()
    {
        return view('pemira.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_urut' => 'required|unique:calons',
            'nama_ketua' => 'required|unique:calons',
            'nama_wakil' => 'unique:calons',
            'jurusan' => 'required',
            'rekam_jejak' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);
        // image calon
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        $calon = new Calon;
        $calon->nomor_urut = $request->nomor_urut;
        $calon->nama_ketua = $request->nama_ketua;
        $calon->jurusan = $request->jurusan;
        $calon->rekam_jejak = $request->rekam_jejak;
        $calon->visi = $request->visi;
        $calon->misi = $request->misi;
        $calon->image = $imageName;
        $calon->save();
        return redirect()->route('pemira.create')->with('success', 'data berhasil disimpan');
    }
}
