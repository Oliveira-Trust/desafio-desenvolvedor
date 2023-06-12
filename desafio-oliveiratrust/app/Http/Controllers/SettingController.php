<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Exception\RequestException;
class SettingController extends Controller
{

    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(int $id)
    {
        $setting = $this->settingService->getSettingById($id);

        return view('settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, int $id)
    {


        try {
            
            DB::beginTransaction();
            $this->settingService->updateSetting($id, $request->all());
            DB::commit();

            return Redirect::route('home')->with('success', 'Configurações de Taxa atualizadas com sucesso!');
        } catch (RequestException $e) {
            return Redirect::route('home')->with('error', 'Erro ao atualizar configuração (1): ' . $e->getMessage());
            DB::rollback();
        } catch (\Exception $e) {
            return Redirect::route('home')->with('error', 'Erro ao atualizar configuração (2): ' . $e->getMessage());
            DB::rollback();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
