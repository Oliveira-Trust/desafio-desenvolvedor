<?php

namespace App\Http\Controllers\Gerencial;

use App\Http\Controllers\Controller;
use App\Http\Models\MovimentacoesFinanceira;
use App\Http\Models\EmpresaPlano;
use App\Http\Models\Empresa;
use App\Http\Models\Loja;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;
use Facade\FlareClient\Stacktrace\File;

class EmpresasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }
    
}
