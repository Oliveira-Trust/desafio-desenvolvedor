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
     * Get the all the product.
     *
     * @return Response
     */
     public function index(){ 
         try {
              
               return $this->product->paginate(4);

            } catch (\PDOException $e){

               return response()->json(['msg'=>$e->getMessage()]);
            }
       
        
     }

     public function search(Request $request){
         try {
            return $this->product->where('title','LIKE','%'.$request->query('title').'%')->paginate(4);

         } catch (\PDOException $e){

            return response()->json(['msg'=>$e->getMessage()]);
         }
     }


     public function store(Request $request){
         try {
            
               $this->product->create($request->all());
               return response()->json(['msg'=>'Registered']);
            
            } catch (\PDOException $e) {

               return response()->json(['msg'=>$e->getMessage()]);
            }
       
     }

   /**
     * Get one Product.
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

    
    public function update(Request $request, $id){
         try {

               $product = $this->product->findOrFail($id);
               $product->update($request->all());

               return response()->json(['msg'=>'Updated successfully'],201);

            } catch (\PDOException $e) {

               return response()->json(['msg'=>$e->getMessage()]);
            }
      
    }

    
    public function delete($id){
         try{
               $products = $this->product->findOrFail($id);
               $products->delete();

               return response()->json('product removed successfully');

            } catch(\PDOException $e){

               return response()->json(['msg'=>$e->getMessage()]);
            }
    }

    public function deleteAll(){
      try{
            $products=$this->product->all();

            //pega cada produto e delata 
            $products->map(function($product){
              $product->delete();
            });

            
            return response()->json('all product removed successfully');

         } catch(\PDOException $e){

            return response()->json(['msg'=>$e->getMessage()]);
         }
   }


 }
 