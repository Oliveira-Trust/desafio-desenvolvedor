<?php

namespace App\Http\Controllers;

 use App\Models\Product;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Http\Request;
 use Illuminate\Support\Str;


 class ProductController extends Controller {

     /** 
     * Instantiate a new ProductController instance.
     *
     * @return void
     */
   private $product;

   public function __construct(Product $product){
          $this->product = $product;
          $this->middleware('auth');
   }

      /**
     * Pega todos os Produtos.
     *
     * @return Response
     */
   public function index(){ 
      try {
         return $this->product->paginate(4);

      } catch (\PDOException $e) {

         return response()->json(['msg'=>$e->getMessage()]);
      }
        
        
   }

      /**
     * Pesquisa por um Produto.
     *
     * @return Response
     */
   public function search(Request $request){
      try {
         return $this->product->where('title','LIKE','%'.$request->query('title').'%')->paginate(4);

      } catch (\PDOException $e) {

         return response()->json(['msg'=>$e->getMessage()]);
      }
         
   }

     /**
     *  Cria um produto.
     *
     * @return Response
     */
   public function store(Request $request){
      try {
         
         $this->product->create($request->all());

         return response()->json(['msg'=>'Registered']);
         
      } catch (\PDOException $e) {

         return response()->json(['msg'=>$e->getMessage()]);
      }
       
   }

    /**
     * Exibe apenas um Produto.
     *
     * @return Response
     */
   public function show($id){
      try {

         $product = $this->product->findOrFail($id);
      
         return response()->json(['Product' => $product], 200);

      } catch (\Exception $e) {

         return response()->json(['message' => 'Product not found!'], 404);
      }
      
   }

    
    /**
     * Atualiza um produto.
     *
     * @return Response
     */
   public function update(Request $request, $id){
      try {
         
         $product = $this->product->findOrFail($id);

         $product->update($request->all());

         return response()->json(['msg'=>'Updated successfully'],201);

      } catch (\PDOException $e) {
         
         return response()->json(['msg'=>$e->getMessage()]);
      }
          
   }

     /**
     * Deleta um Produto.
     *
     * @return Response
     */
   public function delete($id){
      try {
         $products = $this->product->findOrFail($id);

         $products->delete();

         return response()->json('product removed successfully');

      } catch (\PDOException $e) {
        
         return response()->json(['msg'=>$e->getMessage()]);
      }
        
   }

    /**
     * Deleta todos os produtos.
     *
     * @return Response
     */
   public function deleteAll(){
      try {
         $products=$this->product->all();

         $products->map(function($product){  //pega cada produto e delata 
           $product->delete();
         });
         
         return response()->json('all product removed successfully');

      } catch (\PDOException $e) {

         return response()->json(['msg'=>$e->getMessage()]);
      }
      
   }

 }
 