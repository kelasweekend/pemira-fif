<?php

namespace App\Http\Controllers\Excell;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;

class PemilihController extends Controller
{
    public function export_pemilih()
    {
        return (new FastExcel(User::all()))->download('users.csv', function ($user) {
            return [
                'Email' => $user->email,
                'Full Name' => $user->name,
                'NIM' => $user->nim,
                'Jurusan' => $user->jurusan
            ];
        });
    }
    public function import_pemilih(Request $request)
    {
        $request->validate(['excell' => 'required|mimes:xlsx,csv']);
        (new FastExcel)->import($request->excell, function ($line) {
            $user = User::create([
                'nim' => $line['nim'],
                'name' => $line['nama'],
                'email' => $line['nim'] . '@ittelkom-pwt.ac.id',
                'jurusan' => $line['jurusan'],
                'password' => Hash::make($line['nim'])
            ]);
            $user->assignRole('guest');
            return $user;
        });
        return redirect()->route('pemilih.index')->with('success', 'Import User Telah Berhasil');
    }
}
