<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use App\DataTables\UserDataTable;
use Illuminate\Support\Facades\Auth;

class PemilihController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:pemilih-create', ['only' => ['index', 'edit', 'update', 'create', 'store']]);
        $this->middleware('permission:pemilih-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::all();
            return datatables()::of($data)
                ->addColumn('action', function ($row) {
                    if (Auth::user()->hasPermissionTo('view-only')) {
                        $btn = '<button type="button" class="btn btn-secondary col-12">View Only</button>';
                    } else {
                        $btn = '<a href="' . route('pemilih.edit', $row->id) . '"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>';
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-url="' . route('pemilih.destroy', $row->id) . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem"><i class="fas fa-trash"></i></a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pemilih.voter');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pemilih.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:users',
            'name' => 'required',
            'jurusan' => 'required',
        ]);

        User::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->nim . '@ittelkom-pwt.ac.id',
            'jurusan' => $request->jurusan,
            'password' => Hash::make($request->nim)
        ]);

        // $pemilih = new User();
        // $pemilih->nim = $request->nim;
        // $pemilih->name = $request->nama_mahasiswa;
        // $pemilih->email = $request->nim . '@ittelkom-pwt.ac.id';
        // $pemilih->jurusan = $request->jurusan;
        // $pemilih->password = Hash::make($request->nim);
        // $pemilih->save();
        return redirect()->route('pemilih.create')->with('success', 'data berhasil disimpan');

        // dd($request->all());
    }

    public function edit($id)
    {
        $pemilih = User::findorfail($id);
        return view('pemilih.edit', compact('pemilih'));
    }

    public function update(Request $request, $id)
    {
        $pemilih = User::find($id);

        $request->validate([
            'nim' => 'required',
            'name' => 'required',
            'jurusan' => 'required',
        ]);

        User::find($id)->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'email' => $request->nim . '@ittelkom-pwt.ac.id',
            'jurusan' => $request->jurusan,
            'password' => Hash::make($request->nim)
        ]);

        return redirect()->route('pemilih.create')->with('success', 'data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemilih = User::find($id);
        $pemilih->delete();

        return redirect()->route('pemilih.create')->with('success', 'data berhasil dihapus');
    }
}
