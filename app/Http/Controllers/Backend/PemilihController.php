<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class PemilihController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')
                ->whereNotIn('id', [1])
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if (Auth::user()->hasPermissionTo('view-only')) {
                        $btn = '<button type="button" class="btn btn-secondary col-12">View Only</button>';
                    } else {
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem"><i class="fas fa-edit"></i></a>';
                        $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-url="' . route('users.destroy', $row->id) . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem"><i class="fas fa-trash"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('sesi', function ($row) {
                    if ($row->sesi == TRUE) {
                        $sesi = '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input sesi_pasif" id="customSwitch' . $row->id . '" data-id="' . $row->id . '" checked><label class="custom-control-label" for="customSwitch' . $row->id . '">Aktif</label></div>';
                    } else {
                        $sesi = '<div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input sesi_aktif" id="customSwitch' . $row->id . '" data-id="' . $row->id . '"><label class="custom-control-label" for="customSwitch' . $row->id . '">Non Aktif</label></div>';
                    }

                    return $sesi;
                })
                ->rawColumns(['action', 'sesi'])
                ->make(true);
        }
        return view('pemira.pemilih');
    }

    public function sesi_aktif(Request $request)
    {
        User::where('id', $request->id)->update(['sesi' => TRUE]);
        return response()->json(['success' => 'Sesi Berhasil di Aktifkan']);
    }

    public function sesi_pasif(Request $request)
    {
        User::where('id', $request->id)->update(['sesi' => FALSE]);
        return response()->json(['success' => 'Sesi Berhasil di Matikan']);
    }
    public function store(Request $request)
    {
        // if ($request->Item_id == '') {
        //     $validator = Validator::make($request->all(), [
        //         'name' => 'required',
        //         'nim' => 'required|min:8|max:10|unique:users',
        //         'email' => 'required|email|unique:users,email',
        //         'jurusan' => 'required',
        //     ]);
        // } else {
        //     $user = User::findorfail($request->Item_Id);
        //     $validator = Validator::make($request->all(), [
        //         'Item_id' => 'required',
        //         'name' => 'required',
        //         'nim' => 'required|min:8|max:10',
        //         'email' => 'required|email',
        //         'jurusan' => 'required',
        //     ]);
        // }

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()->all()], 200);
        // }

        // if ($request->Item_id == '') {
        //     $user = User::create([
        //         'name' => $request->name,
        //         'nim' => $request->nim,
        //         'email' => $request->email,
        //         'jurusan' => $request->jurusan,
        //         'password' => Hash::make($request->nim),
        //         'sesi' => FALSE
        //     ]);
        //     $user->assignRole('guest');
        //     return response()->json(['success' => 'User Has Been Create']);
        // } else {
        //     return response()->json(['success' => 'User Has Been Update']);
        // }


        // $user = User::updateOrCreate(
        //     ['id' => $request->Item_id],
        //     [
        //         'name' => $request->name,
        //         'nim' => $request->nim,
        //         'email' => $request->email,
        //         'jurusan' => $request->jurusan,
        //         'password' => Hash::make($request->nim),
        //         'sesi' => FALSE
        //     ]
        // );
        // if ($request->Item_id != '') {
        //     DB::table('model_has_roles')->where('model_id', $request->Item_id)->delete();
        //     $user->assignRole('guest');
        // } else {
        //     $user->assignRole('guest');
        // }
        if (empty($request->Item_id)) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'nim' => 'required|min:8|max:10|unique:users',
                'email' => 'required|email|unique:users,email',
                'jurusan' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()], 200);
            }
            $user = User::create([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
                'password' => Hash::make($request->nim),
                'sesi' => FALSE
            ]);
            $user->assignRole('guest');
            return response()->json(['success' => 'User Has Been Create']);
        } else {
            $validator = Validator::make($request->all(), [
                'Item_id' => 'required',
                'name' => 'required',
                'nim' => 'required|min:8|max:10',
                'email' => 'required|email',
                'jurusan' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()], 200);
            }
            $user = User::find($request->Item_id)->update([
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
                'password' => Hash::make($request->nim),
            ]);
            return response()->json(['success' => 'User Has Been Update']);
        }
    }
}
