<?php

namespace App\Http\Controllers;

use App\Mail\CoinAskMail;
use App\Models\CoinAsk;
use Illuminate\Http\Request;
use Http;
use App\Models\Coin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

/**
 * Class CoinAskController
 * @package App\Http\Controllers
 */
class CoinAskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->isAdmin()) $coinAsks = CoinAsk::paginate();
        else $coinAsks = CoinAsk::where('user_id',Auth::user()->id)->paginate();

        return view('coin-ask.index', compact('coinAsks'))
            ->with('i', (request()->input('page', 1) - 1) * $coinAsks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coins = Coin::selectRaw('coin_dest,label')->get()->toArray();

        $coinAsk = new CoinAsk();
        return view('coin-ask.create', compact('coinAsk','coins'));
    }

    
    public function store_public(Request $request)
    {
        // request()->validate(CoinAsk::$rules);
        $data = $request->all();
        $coin = env('API_BASE_COIN').'-'.$data['coin_dest'];
        $response = Http::get(env('API_COINS_ASK_URL').$coin);
        $response = json_decode($response->body(),true) ;
        //dd($data);
        $data['ranting_ask'] = $response[env('API_BASE_COIN').$data['coin_dest']]['ask'];

        if (Auth::user() != null){
            $data['user_id'] = Auth::user()->id;
            $data['email'] = Auth::user()->email;
        }
            
        $coinAsk = new CoinAsk($data);
        

        $coinAsk->save();
        if( env('APP_ENABLE_EMAILS'))
        Mail::to($data['email'])->send(new CoinAskMail($coinAsk));
       
        return view('coin-ask.show', compact('coinAsk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CoinAsk::$rules);

        $coinAsk = CoinAsk::create($request->all());

        return redirect()->route('coin-asks.index')
            ->with('success', 'CoinAsk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coinAsk = CoinAsk::find($id);

        return view('coin-ask.show', compact('coinAsk'));
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $coinAsk = CoinAsk::find($id)->delete();

        return redirect()->route('coin-asks.index')
            ->with('success', 'CoinAsk deleted successfully');
    }
}
