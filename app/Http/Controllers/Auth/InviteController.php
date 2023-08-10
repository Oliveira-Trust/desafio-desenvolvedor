<?php


namespace App\Http\Controllers\Auth;


class InviteController {


    public function edit($token) {
        return view('site::auth.invite');
    }
}
