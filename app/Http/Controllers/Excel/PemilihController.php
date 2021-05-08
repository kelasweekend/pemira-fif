<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

class PemilihController extends Controller
{
    public function index()
    {
        return (new FastExcel(User::all()))->download('user-Date.xls', function ($excel) {
            return [
                'Full Name' => $excel->name,
                'Email' => $excel->email,
                'Join At' => $excel->created_at
            ];
        });
    }


    public function import_pemilih(Request $request)
    {
        $request->validate(['excel' => 'required|mimes:xlsx,csv']);
        (new FastExcel)->import($request->excel, function ($line) {
            $user = User::create([
                'nim' => $line['NIM'],
                'name' => $line['NAMA'],
                'email' => $line['NIM'].'@ittelkom-pwt.ac.id',
                'jurusan' => $line['JURUSAN'],
                'kelas' => $line['KELAS'],
                'sesi' => TRUE,
                'password' => Hash::make($line['NIM'])
            ]);
            $user->assignRole('guest');
            return $user;
        });
        return redirect()->route('pemilih.index')->with('success', 'Import User Telah Berhasil');
    }
}
