<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Vote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function validasi()
    {
        return view('frontend.validasi');
    }

    public function validasi_send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nim' => 'required|max:9',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Silahkan Masukan Nim Anda'], 200);
        }

        // validasi data

        $user = User::select('id', 'nim')->where('nim', $request->nim)->first();
        if (empty($user)) {
            return response()->json(['error' => 'NIM Tidak Terdaftar'], 200);
        } else {
            $vote = Vote::where('id_user', $user->id)->first();
            if (empty($vote)) {
                return response()->json(['success' => 'NIM Terdaftar Silahkan Vote Paslon'], 200);
            } else {
                return response()->json(['success' => 'NIM Terdaftar anda Sudah Vote Paslon'], 200);
            }
        }
    }
}
