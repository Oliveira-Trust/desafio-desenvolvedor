<?php

namespace App\Http\Controllers;

 use Illuminate\Support\Facades\Auth;
 use Illuminate\Http\Request;
 use App\Models\Product;
 use Illuminate\Support\Str;


class RequestProductController extends Controller {

     private $user;
     private $product;

   public function __construct(Product $products){
     
          $this->middleware('auth');
          $this->user = Auth::user();
          $this->product = $products;
   }

   /**
     * Cria um pedido feito pelo usuario
     *
     * @return Response
     */
   public function store(Request $request){
      try {

         $this->user->Products()->attach($request->product_id,['status' => $request->status,]); // attach: passando um arry de valores para um relacionamento muitos para muitos  
              
         return response()->json(['msg'=>'request registered']);

      } catch (\PDOException $e) {

         return response()->json(['msg'=>$e->getMessage()],404);
      }
       
   }

   /**
     * pega todos os produtos que o usuario tem 
     *
     * @return Response
     */
   public function showProductUser(){
      try {

         $requestOfProduct = $this->user->Products()->get();
           
         return response()->json(['Product' => $requestOfProduct], 200);

      } catch (\Exception $e) {

         return response()->json(['msg'=>$e->getMessage()],404);
      }
       
   }

  /**
   * pega todos os usuarios que  o produto  tem 
   *
   * @return Response
   */
   public function showUserProduct($id){
      try {
         $requestOfProduct = $this->product->find($id)->Users()->get();
        
         return response()->json(['Product' => $requestOfProduct], 200);

      } catch (\Exception $e) {

         return response()->json(['msg'=>$e->getMessage()],404);
      }
       
      
   }


   /**
     * Atualiza o status do pedido
     *
     * @return Response
     */
   public function update(Request $request, $id){
      try {
         $requestOfProduct = $this->user->Products()->where('product_id',$id)->get()->first();
         
         $requestOfProduct->pivot->status=$request->status;
         
         $requestOfProduct->pivot->save();
         
        
         return response()->json(['msg'=>'Atualizado com sucesso'],201);

      } catch (\PDOException $e) {

         return response()->json(['msg'=>$e->getMessage()],404);
      }
       
   }

   /**
   * deleta o pedido do usuario
   *
   * @return Response
   */
   public function delete($id){
      try {

         $products =  $this->user->Products()->where('product_id',$id)->get()->first();
         $products->pivot->delete();

         return response()->json('User removed successfully');

      } catch (\Throwable $th) {

         return response()->json(['msg'=>$e->getMessage()]);
      }
         
   }

}
 