<?php

namespace App\Http\Controllers;


use App\User;
use App\Status;
use App\Models\WhatsappMessage;
use Artisan;
use Carbon\Carbon;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\WhastappService as WhatsappService;

use Image;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;
use Spatie\Geocoder\Geocoder;

class WhatsappController extends Controller {

   

    private $parameters = [''];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // dd(Auth::User());
////            dd($result);
            if (WhatsappService::isConnected(Auth::User()->contact())) {
//                          
            return view('whatsapp.index', [               
                'device' => ['session' =>Auth::User()->contact()]
//                'device' => WhatsappService::getMobileInfo(auth()->user()->restorant->phone)
            ]);
            }else{
                return view('whatsapp.index_no');
            }
       
    }

    
    public function send($id) {
   if (WhatsappService::isConnected(Auth::User()->phone)) {
       WhatsappService::sender(Auth::User()->phone,$id,'Teste de ssitema');
    }
return redirect()->route('whatsapp.index')->withStatus(__('Mengem removida com sucesso'));
    }
    
   }

