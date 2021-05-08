<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Calon;
use App\Models\Frontend\Vote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\False_;

class VoteController extends Controller
{
    public function index()
    {
        $vote = Calon::all();
        return view('frontend.vote', compact('vote'));
    }

    public function quickcount()
    {
        return view('frontend.quickcount');
    }
    public function detail($id)
    {
        $item = Calon::find($id);
        return response()->json($item);
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

                User::find(auth()->user()->id)->update(['sesi'=>False]);

                // $this->guard()->logout();
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
