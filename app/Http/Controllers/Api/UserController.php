<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Repository\UserRepository;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $userRepository = new UserRepository($this->user);

            if($request->has("coditions")) {
                $userRepository->selectCoditions($request->coditions);
            }

            if($request->has("fields")) {
                $userRepository->selectFilter($request->fields);
            }

            return new UserCollection($userRepository->getResult()->paginate(10));

        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->all();

            $data["password"] = bcrypt($data["password"]);
            $this->user->create($data);

            $message = new ApiMessages("User successfully created");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->user->findOrFail($id);

            return new UserResource($user);
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $userRepository = new UserRepository($this->user);

            if($userRepository->validationUpdate($request, $id)) {

                $data = $request->all();
                $data["password"] = bcrypt($data["password"]);

                $user = $this->user->findOrFail($id);
                $user->update($data);
            }

            $message = new ApiMessages("User successfully updated");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
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
        try {
            $user = $this->user->findOrFail($id);
            $user->delete();

            $message = new ApiMessages("User successfully deleted");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}
