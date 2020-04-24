<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\User;

class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    private $user;

    public function __construct(User $users){
        $this->middleware('auth');
        $this->user=$users;
    }

    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile(){
        return response()->json(['user' => Auth::user()], 200);
    }

    /**
     * Get all User.
     *
     * @return Response
     */
    public function index(){
        return response()->json(['users' =>  $this->user->paginate(4)], 200);
    }


    public function store(Request $request){
        try {
               $this->user->create($request->all());
               
               return response()->json(['msg'=>$request->all()]);
            
            } catch (\PDOException $e) {

               return response()->json(['msgerro'=>$e->getMessage()],406);
            }
     }
    /**
     * Get one user.
     *
     * @return Response
     */
    public function show($id){
        try {
                $user = $this->user->findOrFail($id);
            
                return response()->json(['user' => $user], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }
    }

    public function update(Request $request, $id){
        try {

            $user = $this->user->findOrFail($id);
            $user->update($request->all());

            return response()->json(['msg'=>'User updated successfully'],201);

         } catch (\PDOException $e) {

            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    public function delete($id){
       
        try{
            $user = $this->user->findOrFail($id);
            $user->delete();

            return response()->json('User removed successfully');

        } catch(\PDOException $e){

            return response()->json(['msg'=>$e->getMessage()]);
        }


    }

}




