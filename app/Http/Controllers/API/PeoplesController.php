<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Peoples;
use Illuminate\Support\Facades\Validator;

class PeoplesController extends BaseController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = array('full_name' => 'unique:peoples');
        $input['full_name'] = $request->full_name;
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $request->validate([
            'full_name' => 'required',
            'brithday_age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'career' => 'required',
        ]);

        Peoples::create($request->all());
        return $this->sendResponse($request->all(), 'Created with successfull!!');
    }

    /**
     * select alll and return json
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function all(Request $request)
    {
        return $this->sendResponse(Peoples::all(), 'selected with successfull!!');
    }

    /**
     * select one and return json
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function one(Request $request, Peoples $people)
    {
        $resp = $people->where('full_name', $request->full_name)->get();
        if (count($resp) > 0)
            return $this->sendResponse($resp, 'selectedBy with successfull!!');
        else
            return $this->sendResponse($resp, "selectedBy failed, don't exist it row!!");
    }

    /**
     * select one and return json
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peoples $people)
    {
        $resp = $people->where('full_name', $request->full_name)->update(['full_name' => $request->full_name]);
        if ($resp > 0)
            return $this->sendResponse($resp, 'Update with successfull!!');
        else
            return $this->sendResponse($resp, "Update failed, don't exist it row!!");
    }

    /**
     * deleteAll
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteAll(Request $request, Peoples $people)
    {
        $resp = $people->truncate();
        return $this->sendResponse($resp, "All Deleted");
    }
}
