<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list
    public function productlist(){
        $products = Product::when(request('key'),function($query){
                        $query->where('products.name','like','%'. request('key').'%');
                        })
                        ->select('products.*','categories.name as category_name')//,'categories.id as category_table_id'
                        ->join('categories','products.category_id','categories.id')
                        ->orderBy('created_at','desc')
                        ->paginate(5);
        $products->appends(request()->all());
      // dd($products->toArray());
        return view('admin.product.list',compact('products'));
    }

    //product create
    public function productcreate(){
        $categories = Category::pluck('name', 'id');//the pluck() method to retrieve only specific columns from a table
        //$categories = Category::select('id', 'name')->get();//the select() method to specify which columns you want to retrieve
        //dd($categories);
        return view('admin.product.create',compact('categories'));
    }

    //product store
    public function productstore(Request $request){

       // dd($request->all());
        $product = $this->getPizzaData($request);
        //dd($product->$validationRules);
        if ($request->hasFile('pizzaImage')) {
            $pizzaImage = $request->file('pizzaImage');
            $originalName = uniqid() . $pizzaImage->getClientOriginalName();
        
            // Move the file to the desired location
            $pizzaImage->move(storage_path('app/public'), $originalName);
        
            $product['image'] = $originalName;
        }
        
       Product::create($product);
       return redirect()->route('admin#productlist')->with(['create'=>'New Product Created Success']);
    }

    //product delete
    public function productdelete($id){
        $productImage = Product::select('image')->where('id',$id)->first();
        //dd($productImage->image);

        if($productImage->image != null ):
            Storage::delete('public/'.$productImage->image);
        endif;

        Product::where('id',$id)->delete();
        return back()->with(['delete'=>'Product deleted...']);
    }

    //pruduct edit
    public function productedit($id){
       // $categories = Category::pluck('name', 'id');

        $categories =Category::select('name','id')->get();
        //dd($categories->toArray());

        $product = Product::where('id',$id)->first();
        //dd($product->category_id);
        //dd($product->toArray());
        return view('admin.product.edit',compact('product','categories'));

    }

    //product update
    public function productupdate($id,Request $request){
        $request['id'] =$id;
        //dd(old('pizzaCategory'));
        //dd(gettype($request->pizzaCategory));
        $product = $this->getUpdateProductData($request);



        $dbproduct = Product::find($id);
        if ($request->hasFile('pizzaImage')) {


            if($dbproduct->image != null ):
                Storage::delete('public/'.$dbproduct->image);
                 // Get the uploaded file
                $updateImage = $request->file('pizzaImage');
                // Get the original file name
                $originalName = uniqid().$updateImage->getClientOriginalName();
                $updateImage->StoreAs('public',$originalName);
                $product['image'] = $originalName;
            else:
                $product['image'] = $dbproduct->image;
            endif;
       }


       //dd($product);
       Product::where('id',$id)->update($product);

       return redirect()->route('admin#productlist')->with(['update'=>'Your product has been updated.']);
    }

    public function productdetail($id){
        $product = Product::findOrFail($id);

        return view('admin.product.detail',compact('product'));
    }





    private function getPizzaData($request){

        //$validationRules['pizzaImage'] = $action == 'create' ? "['mimes:jpeg,png,gif,jpg,webp,svg','required','image','max:2048']" : "['mimes:jpeg,png,gif,jpg,webp,svg','image','max:2048']";
        Validator::make($request->all(),  [
            'pizzaName' => ['required', 'string', 'max:255'],
            'pizzaDescription' => ['required', 'string'],
            'productCategory' => ['required'],
            'pizzaPrice' => ['required'],
            'pizzaWaitingTime' => ['required'],
            'pizzaImage' => ['mimes:jpeg,png,gif,jpg,webp,svg','required','image','max:2048'],
        ])->validate();

        return [
            'name' => $request->pizzaName,
            'slug' => Str::slug($request->pizzaName),
            'description' => $request->pizzaDescription,
            'category_id' => $request->productCategory,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

    private function getUpdateProductData($request){
        Validator::make($request->all(), [
            'pizzaName' => ['required', 'string', 'max:255'],
            'pizzaDescription' => ['required', 'string'],
            'category' => ['required'],
            'pizzaPrice' => ['required'],
            'pizzaWaitingTime' => ['required'],
            'pizzaStatus' => ['required'],
            'pizzaImage' => ['mimes:jpeg,png,gif,jpg,webp,svg','image','max:2048'],
            //'pizzaImage.*' => ['mimes:jpeg,png,gif,jpg'],

        ])->validate();

        return [
            'name' => $request->pizzaName,
            'slug' => Str::slug($request->pizzaName),
            'description' => $request->pizzaDescription,
            'category_id' => $request->category,
            'price' => $request->pizzaPrice,
            'status' => $request->pizzaStatus,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }
}
