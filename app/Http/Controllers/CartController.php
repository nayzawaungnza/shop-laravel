<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    //Cart Page
    public function cart(){
       // $categories = Category::orderby('created_at','desc')->get();
        // session()->flush('success','Session Delete successfully!');
         //$allSessions = session('cart');
         //dd($allSessions);

         $carts = Cart::select('carts.*','products.name', 'products.image','products.price')//,'categories.id as category_table_id'
                        ->join('products','products.id','carts.product_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();
         //dd($carts->isEmpty());

        //$cart = session()->get('cart');

        //$subtotal = $this->calculateSubtotal($carts);
        $subtotal = Cart::where('user_id', Auth::user()->id)
                    ->sum('total');
        $tax = $this->getTax($subtotal);
       // $shipping = 3500;
        $total = $subtotal + $tax ;
        //$cartCount = Cart::where('user_id', Auth::user()->id)->count();
        //dd($subtotal);
        return view('customer.cart',compact( 'carts','subtotal','tax','total'));
    }
    //Add cart
    public function addcart(Request $request)
{
    //logger($request->all());
    $product = Product::find($request->id);
    //logger($product);
    if (!$product) {
        return response()->json(['error' => 'Product not found.']);
    }

    // if (!Auth::check()) {
    //     return redirect()->route('customer#signin');
    // }

    $cart = Cart::where('user_id', Auth::user()->id)
                ->where('product_id', $product->id)
                ->first();

    if (!$cart) {
        // $cart = [
        //     'user_id' => Auth::user()->id,
        //     'product_id' => $product->id,
        //     'quantity' => $request->qty,
        //     'total' => $product->price * $request->qty,
        // ];
        $cart = $this->getCartData($request);
        //logger($cart);
        Cart::create($cart);
    } else {
        $quantity = $cart->quantity + $request->qty;

        if ($quantity <= 0) {
            $cart->delete();
        } else {
            $cart->quantity = $quantity;
            $cart->total = $product->price * $quantity;
            $cart->save();
        }
    }

    // $total = Cart::where('user_id', Auth::user()->id)
    //             ->sum('total');

    //$cartCount = Cart::where('user_id', Auth::user()->id)->count();

    return response()->json(['success' => 'Item added to cart.']);//, 'total' => $total
}


//update cart
public function update(Request $request){
    //logger($request->all());

    $product_id = $request->id;
    $qty = $request->qty;
    $product = Product::find($product_id);
    $cart = Cart::where('user_id', Auth::user()->id)
            ->where('product_id', $product_id)
            ->first();

        if ($cart) {
            $cart->quantity = $qty;
            $cart->total = $product->price * $qty;
            $cart->save();

            // Calculate new subtotal and total
            //$subtotal = $this->calculateSubtotal($cart);

            $subtotal = Cart::where('user_id', Auth::user()->id)
                            ->sum('total');

            $tax = $this->getTax($subtotal);
            //$shipping = 3500;
            $total = $subtotal + $tax ;
            //$cartCount = Cart::where('user_id', Auth::user()->id)->count();
            //logger($cart);
            // Return updated cart data
            return response()->json([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
                //'cartcount' => $cartCount
            ]);

        } else {
            return response()->json(['error' => 'Cart not found']);
        }

}


    public function remove(Request $request)
    {
        //logger($request->all());
        $id = $request->cartid;
        $productid = $request->productid;

        // Get the cart item by ID
        $cartItem = Cart::where('id', $id)
                        ->where('product_id', $productid)
                        ->first();

        // Delete the cart item from the database
        $cartItem->delete();



        //$subtotal = $this->calculateSubtotal($cart);
        $subtotal = Cart::where('user_id', Auth::user()->id)
                            ->sum('total');
        $tax = $this->getTax($subtotal);
        //$shipping = 3500;
        $total = $subtotal + $tax ;
        //$cartCount = Cart::where('user_id', Auth::user()->id)->count();
        //logger($subtotal);

        return response()->json([
            'success' => 'Item removed from cart.',
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            //'cartcount' => $cartCount
        ]);
    }


// private function calculateSubtotal($carts)
// {
//     $subtotal = 0;
//     logger($carts->toArray());
//     if($carts){
//         foreach ($carts as $item) {
//             $subtotal += $item->total;
//         }
//     }

//     return $subtotal;
// }

private function getTax($subtotal)
{
    return $subtotal * 0.01; // Replace with your own tax calculation
}

private function getCartData($request){

    $product = Product::find($request->id);
    return [
        'user_id' => Auth::user()->id,
        'product_id' => $product->id,
        'quantity' => $request->qty,
        'total' => $product->price * $request->qty,
    ];
}

}
