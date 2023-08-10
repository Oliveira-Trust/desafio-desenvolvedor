<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $msg;
    private $type = 'success';
    private $url;

    protected function successView($view, $data = [], $msg = null) {
        if (request()->ajax()) {
            return response()->json(['msg' => $msg, 'type' => $this->type, 'html' => view($view, $data)->render()]);
        }
    }

    protected function successNotify($msg) {
        request()->session()->flash('_notify_success', $msg);
    }

    /**
     * Retorna uma mensagem ajax
     *
     * @param $msg
     * @param bool $clear
     * @param null $back_url
     *
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    protected function successMsg($msg, $clear = false, $back_url = null) {
        if (request()->ajax()) {
            return response()->json(compact('msg', 'clear'));
        }

        flash()->success($msg)->important();

        if ($back_url) {
            return redirect($back_url);
        }

        return redirect()->back();
    }

    protected function successPopupMsg($msg, $clear = false, $back_url = null) {
        if (request()->ajax()) {
            return response()->json(['popup' => $msg]);
        }

        //flash()->success($msg)->important();

        if ($back_url) {
            return redirect($back_url);
        }

        return redirect()->back();
    }

    /**
     * Redireciona para a Url com Mensagem
     *
     * @param $url
     * @param null $msg
     *
     * @return Application|JsonResponse|RedirectResponse|Redirector
     */
    protected function successUrl($url, $msg = null) {
        if (request('r')) {
            $url = request('r');
        }

        if ($msg) {
            flash()->success($msg)->important();
        }

        if (request()->ajax()) {
            return response()->json(compact('url'));
        }

        return redirect($url);
    }

    protected function successRoute($route, $parameters = null, $msg = null) {
        if (request('r')) {
            $url = request('r');
        } else {
            $url = route($route, $parameters);
        }

        if ($msg) {
            flash()->success($msg)->important();
        }

        if (request()->ajax()) {
            return response()->json(compact('url'));
        }

        return redirect($url);
    }

    protected function errorUrl($url, $msg = null) {
        if ($msg) {
            flash()->error($msg)->important();
        }

        if (request()->ajax()) {
            return response()->json(compact('url'));
        }

        return redirect($url);
    }
}
