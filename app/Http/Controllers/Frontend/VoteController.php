<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoteController extends Controller
{
    public function index()
    {
        return view('frontend.vote');
    }

    public function send_voting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'calon' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Calon tidak ditemukan'], 200);
        }

        if (auth()->user()){
            $user = Vote::where('id_user', auth()->id())->first();
            if(empty($user)){
                
                $vote = new Vote();
                $vote->id_user = auth()->id();
                $vote->id_calon = $request->calon;
                $vote->save();

                return response()->json(['success' => 'Terima Kasih Telah Memilih'], 200);
            }else{
                return response()->json(['error' => 'sudah vote anda'], 200);
            }
        }else{
            return response()->json(['error' => 'Silahkan Login'], 200);
        }
    }

    public function bukti()
    {
        $vote = Vote::where('id_user', auth()->id())->first();
        if(empty($vote)){
            return redirect()->route('vote');
        }else{
            dd($vote);
        }
    }
}
