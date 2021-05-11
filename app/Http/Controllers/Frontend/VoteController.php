<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Calon;
use App\Models\Frontend\Vote;
use App\Models\Setting\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class VoteController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:vote-admin', ['only' => ['dashboard', 'hapus_vote']]);
    }
    public function index()
    {
        $vote = Calon::all();
        return view('frontend.vote', compact('vote'));
    }
    public function dashboard(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('votes')
                ->select('votes.*', 'users.name', 'calons.nama_ketua')
                ->join('users', 'votes.id_user', '=', 'users.id')
                ->join('calons', 'votes.id_calon', '=', 'calons.id')
                ->get();
            return Datatables::of($data)
                ->addColumn('action', function ($row) {
                    $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-url="' . route('hapus_vote', $row->id) . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $aktif = User::where('sesi', TRUE)->count();
        $pasif = User::where('sesi', FALSE)->count();
        $suara = Vote::all()->count();
        $pemilih = User::all()->count();
        return view('vote.index', compact('aktif', 'pasif', 'suara', 'pemilih'));
    }
    public function hapus_vote($id)
    {
        Vote::find($id)->delete();
        return response()->json(['success' => 'Item deleted successfully.']);
    }

    public function quickcount()
    {
        $set = Setting::find(1);
        if ($set->tanggal == date('Y-m-d')) {
            $total_pemilih = User::all()->count();
            $suara_masuk = Vote::all()->count();
            $golput = User::where('sesi', TRUE)->count();
            $paslon = Calon::all();
            $calon = [];
            foreach ($paslon as $pesaing) {
                $calon[] = $pesaing->id;
            }
            $user = [];
            foreach ($calon as $key => $value) {
                $user[] = Vote::where('id_calon', $value)->count();
            }
            return view('frontend.quickcount', [
                'year' => json_encode($calon, JSON_NUMERIC_CHECK),
                'month' => json_encode($calon, JSON_NUMERIC_CHECK),
                'day' => json_encode($calon, JSON_NUMERIC_CHECK),
                'user' => json_encode($user, JSON_NUMERIC_CHECK),
                'total_pemilih' => $total_pemilih,
                'suara_masuk' => $suara_masuk,
                'golput' => $golput,
            ]);
        } else {
            return view('frontend.coming', compact('set'));
        }
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

        if (auth()->user()) {
            $user = Vote::where('id_user', auth()->id())->first();
            if (empty($user)) {

                $vote = new Vote();
                $vote->id_user = auth()->id();
                $vote->id_calon = $request->calon;
                $vote->save();

                User::find(auth()->user()->id)->update(['sesi' => False]);

                // $this->guard()->logout();
                return response()->json(['success' => 'Terima Kasih Telah Memilih'], 200);
            } else {
                return response()->json(['error' => 'sudah vote anda'], 200);
            }
        } else {
            return response()->json(['error' => 'Silahkan Login'], 200);
        }
    }

    public function bukti()
    {
        $vote = Vote::where('id_user', auth()->id())->first();
        if (empty($vote)) {
            return redirect()->route('vote');
        } else {
            dd($vote);
        }
    }
}
