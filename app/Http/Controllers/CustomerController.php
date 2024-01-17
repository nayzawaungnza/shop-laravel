<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //signin
    public function signin(){

        //$categories = Category::orderby('created_at','desc')->get();

        if(Auth::check()):
            return redirect()->route('customer#myaccount');
        endif;

        return view('customer.signin');
    }

    public function signup(){
        //$categories = Category::orderby('created_at','desc')->get();
        if(Auth::check()):
            return redirect()->route('customer#myaccount');
        endif;

        return view('customer.signup');
    }

    public function index(){
        //$categories = Category::orderby('created_at','desc')->get();

        $products = Product::where('status','0')->with('reviews')->orderby('created_at','desc')->get();

        //dd($products->toArray());
        return view('customer.home',compact('products'));
    }

    public function productcategoryslug($slug){
        //$categories = Category::orderby('created_at','desc')->get();
        $products = Product::select('products.*','categories.name as category_name','categories.slug as category_slug')//,'categories.id as category_table_id'
                            ->join('categories','products.category_id','categories.id')
                            ->where('status','0')
                            ->where('categories.slug', $slug)
                            ->orderby('created_at')->get();


        return view('customer.home',compact('products'));

    }

    public function productdetail($slug){
        //$categories = Category::orderby('created_at','desc')->get();
        $product = Product::where('slug', $slug)->firstOrFail();
        // Increment the view count
        //dd($product->toarray());
        $product->increment('view_count');


        $comments = Comment::with('customer', 'product','likes','replies.customer','replies.likes')
                ->where('product_id', $product->id)
                ->whereNull('parent_id')
                ->get();
        //dd($comments->toArray());

        //For You may also like
        $products = Product::where('status','0')->with('reviews')->orderby('created_at','desc')->get();

        $reviews = Review::where('product_id', $product->id)->with('customer')->get();

        if (Auth::check()) {
        $customer = Auth::user();


        $order = $customer->orders()->with('items')
                            //->where('status', 'completed')
                            ->whereIn('status', ['completed', 'shipped', 'delivered'])
                            ->whereHas('items', function ($query) use ($product) {
                            $query->where('product_id', $product->id);
                        })->get();

        $existingReview = Review::where('customer_id', $customer->id)
                                    ->where('product_id', $product->id)
                                    ->get();
                                     //dd($existingReview->count());
                                     //dd($existingReview->toarray());

        return view('customer.details', compact('product','products','comments','reviews','order','existingReview'));
        }

        return view('customer.details', compact('product','products','comments','reviews'));
    }

    public function myaccount(){
        //$categories = Category::orderby('created_at','desc')->get();
        $orders = Order::where('customer_id', Auth::id())->with('items')
                        ->with('shipping_country')->with('shipping_state')->with('shipping_township')
                        ->with('different_shipping_country')->with('different_shipping_state')->with('different_shipping_township')
                        ->get();
        //dd($orders->toArray());
        return view('customer.my-account',compact('orders'));

    }

    public function updateprofile(Request $request){


        $data = $this->getProfileData($request);

        if ($request->hasFile('image')) {
             $user = User::find(Auth::user()->id);

             if($user->image != null ):
                 Storage::delete('public/'.$user->image);
             endif;
             // Get the uploaded file
             $profileImage = $request->file('image');
             // Get the original file name
             $originalName = uniqid().$profileImage->getClientOriginalName();
             $profileImage->StoreAs('public',$originalName);
             $data['image'] = $originalName;

        }

        User::where('id',Auth::user()->id)->update($data);


        return redirect()->route('customer#myaccount')->with(['update'=>'Your profile has been updated.']);
     }

     public function passwordchangestore(Request $request){


        //dd($request->all());

        $this->passwordValidationCheck($request);

        if(Hash::check($request->oldPassword, Auth()->user()->password)) {

            if(!Hash::check($request->newPassword, Auth()->user()->password)):
                User::where('id',Auth()->user()->id)->update([
                    'password' => Hash::make($request->newPassword),
                ]);
                session()->flush('success','Password updated successfully!');
                //return redirect()->route('customer#signin');
                return redirect()->route('customer#myaccount');
            else:
                session()->flush('message','New password can not be the old password!');
                return redirect()->route('customer#myaccount');
            endif;

        }else{
            session()->flush('message','Old password does not matched!');
            return redirect()->route('customer#myaccount');
        }

    }


    public function contact(){

    }


    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6|different:oldPassword',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ],
        [])->validate();
    }

    private function getProfileData($request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
            'phone' => ['required'],
            'address' => ['required'],
            'gender' => ['required', 'in:male,female,other'], // Add validation rule for gender
            'image' => ['mimes:jpeg,png,gif,jpg','max:2048'],

        ])->validate();

        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'updated_at' => Carbon::now(),
        ];
    }
}
