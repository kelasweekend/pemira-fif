<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Models\Backend\Calon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class PemiraController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:calon-create', ['only' => ['index', 'edit', 'store', 'create', 'update']]);
        $this->middleware('permission:calon-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Calon::all();
            return datatables()::of($data)
                ->addColumn('action', function ($row) {
                    if (Auth::user()->hasPermissionTo('view-only')) {
                        $btn = '<button type="button" class="btn btn-secondary col-12">View Only</button>';
                    } else {
                        $btn = '<a href="' . route('pemira.edit', $row->id) . '" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>';
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-url="' . route('pemira.destroy', $row->id) . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem"><i class="fas fa-trash"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            return $btn;
        }
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
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $calon = new Calon;
        $calon->nomor_urut = $request->nomor_urut;
        $calon->nama_ketua = $request->nama_ketua;
        $calon->jurusan = $request->jurusan;
        $calon->rekam_jejak = $request->rekam_jejak;
        $calon->visi = $request->visi;
        $calon->misi = $request->misi;
        $calon->image = $imageName;

        if ($request->nama_wakil != "") {
            $calon->nama_wakil = $request->nama_wakil;
        }

        $calon->save();
        return redirect()->route('pemira.create')->with('success', 'data berhasil disimpan');
    }

    public function edit($id)
    {

        $calon = Calon::findorfail($id);
        return view('pemira.edit', compact('calon'));

        //dd($calon);
    }

    public function update(Request $request, $id)
    {
        $calon = Calon::find($id);

        $request->validate([
            'nomor_urut' => 'required|',
            'nama_ketua' => 'required|',
            'jurusan' => 'required',
            'rekam_jejak' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        if ($request->nama_wakil != "") {

            Calon::find($id)->update([
                'nomor_urut' => $request->nomor_urut,
                'nama_ketua' => $request->nama_ketua,
                'nama_wakil' => $request->nama_wakil,
                'jurusan' => $request->jurusan,
                'rekam_jejak' => $request->rekam_jejak,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'image' => $imageName
            ]);
        } else {
            Calon::find($id)->update([
                'nomor_urut' => $request->nomor_urut,
                'nama_ketua' => $request->nama_ketua,
                'nama_wakil' => $request->nama_wakil,
                'jurusan' => $request->jurusan,
                'rekam_jejak' => $request->rekam_jejak,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'image' => $imageName
            ]);
        }


        return redirect()->route('pemira.create')->with('success', 'data berhasil diupdate');
    }



    public function destroy($id)
    {
        $calon = Calon::find($id);
        $calon->delete();

        return redirect()->route('pemira.create')->with('success', 'data berhasil dihapus');
    }
}
