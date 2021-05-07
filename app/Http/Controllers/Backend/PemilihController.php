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
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pemira.pemilih');
    }
    public function store(Request $request)
    {
        if ($request->Item_id == '') {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'nim' => 'required|min:8|max:10|unique:users',
                'email' => 'required|email|unique:users,email',
                'jurusan' => 'required',
                'password' => 'required|same:confirm-password',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'Item_id' => 'required',
                'name' => 'required',
                'nim' => 'required|min:8|max:10|unique:users',
                'email' => 'required|email|unique:users,email',
                'jurusan' => 'required',
                'password' => 'same:confirm-password',
            ]);
        }

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 200);
        }
        $user = User::updateOrCreate(
            ['id' => $request->Item_id],
            [
                'name' => $request->name,
                'nim' => $request->nim,
                'email' => $request->email,
                'jurusan' => $request->jurusan,
                'password' => Hash::make($request->password)
            ]
        );
        if ($request->Item_id != '') {
            DB::table('model_has_roles')->where('model_id', $request->Item_id)->delete();
            $user->assignRole('guest');
        } else {
            $user->assignRole('guest');
        }
        return response()->json(['success' => 'Item deleted successfully.']);
    }
}
