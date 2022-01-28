<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\UserService;

class UserController
{
    private $service;

    public function __construct(UserService $objUserService, Request $request){
       
        $this->service = $objUserService;
    }

    public function index(){
       
        return $this->service->index();
 
     }
 
     public function create(Request $request){
     
         return $this->service->updateOrCreate($request->all());
 
     }
 
     public function update(Int $id){
         
         return $this->service->updateOrCreate($request->all(), $id);
 
     }
 
     public function show(Int $id){
         
         return $this->service->show($id);
 
     }
 
     public function delete(Int $id){
         
         return $this->service->delete($id);
 
     }
 
     public function destroy(Int $id){
         
         return $this->service->destroy($id);
 
     }
   
}
