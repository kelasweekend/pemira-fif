<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'Masukan Tanggal Quickcount'], 200);
        }

        Setting::find(1)->update(['tanggal'=> $request->tanggal]);
        return response()->json(['success' => 'QuickCount Berhasil di setting'], 200);
    }
}
