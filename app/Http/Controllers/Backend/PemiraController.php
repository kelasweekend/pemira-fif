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
        $calon = Calon::all();
        return view('pemira.calon', compact('calon'));
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
        if ($request->nama_wakil != "") {
            $calon->nama_wakil = $request->nama_wakil;
        }
        $calon->jurusan = $request->jurusan;
        $calon->rekam_jejak = $request->rekam_jejak;
        $calon->visi = $request->visi;
        $calon->misi = $request->misi;
        $calon->image = $imageName;
        $calon->save();
        return redirect()->route('pemira.index')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {
        $calon = Calon::findorfail($id);
        return view('pemira.edit', compact('calon'));
        // dd($calon);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_urut' => 'required',
            'nama_ketua' => 'required',
            'nama_wakil' => '',
            'jurusan' => 'required',
            'rekam_jejak' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $calon = Calon::findorfail($id);

        // update image
        if ($request->image != '') {
            //code for remove old file
            if ($calon->image != ''  && $calon->image != null) {
                $image_path = public_path('images/'.$calon->image);
                unlink($image_path);
            }
            //upload new file
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            //for update in table
            $calon->update(['image' => $imageName]);
        }

        // update data
        Calon::whereid($id)->update([
            'nomor_urut' => $request->nomor_urut,
            'nama_ketua' => $request->nama_ketua,
            'jurusan' => $request->jurusan,
            'rekam_jejak' => $request->rekam_jejak,
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);
        if ($request->nama_wakil != "") {
            Calon::whereid($id)->update([
                'nama_wakil' => $request->nama_wakil,
            ]);
        }
        return redirect()->route('pemira.index')->with('success', 'data berhasil di update');
    }

    public function destroy($id)
    {
        $calon = Calon::find($id);
        $image_path = public_path('images/'. $calon->image);
        unlink($image_path);
        $calon->delete();
        return redirect()->route('pemira.index')->with('success', 'data berhasil di hapus');
    }
}
