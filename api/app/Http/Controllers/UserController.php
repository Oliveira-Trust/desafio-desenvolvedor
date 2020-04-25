<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use  App\Models\User;

class UserController extends Controller
{
     
    private $user;

    public function __construct(User $users){// 
        $this->middleware('auth');
        $this->user=$users;
    }

    
    /**
     * Pega todos os usuarios.
     *
     * @return Response
     */
    public function index(){
        try {
            return response()->json(['users' =>  $this->user->paginate(4)], 200);

        } catch (\PDOException $e) {
            
            return response()->json(['msgerro'=>$e->getMessage()],406);
        }
       
    }

    /**
     * \cria um  usuario.
     *
     * @return Response
     */
    public function store(Request $request){
        
        try {
            $this->user->create($request->all());

            return response()->json(['msg'=>$request->all()]);
            
        } catch (\PDOException $e) {

            return response()->json(['msgerro'=>$e->getMessage()],406);
        }
        
     }

    /**
     * pega apenas um  usuario.
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


     /**
     * Atualiza um usuario.
     *
     * @return Response
     */
    public function update(Request $request, $id){
        try {

            $user = $this->user->findOrFail($id);
            $user->update($request->all());

            return response()->json(['msg'=>'User updated successfully'],201);

         } catch (\PDOException $e) {

            return response()->json(['msg'=>$e->getMessage()]);
        }
    }

    /**
     * deleta um usuario.
     *
     * @return Response
     */
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




