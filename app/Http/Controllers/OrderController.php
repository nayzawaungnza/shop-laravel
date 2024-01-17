<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Country;
use App\Models\Category;
use App\Models\OrderItem;
use App\Mail\NewOrderEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
define("DOMPDF_UNICODE_ENABLED", true);

class OrderController extends Controller
{
    //Checkout page
    public function checkout(){
        $categories = Category::orderby('created_at','desc')->get();
        $carts = Cart::select('carts.*','products.name', 'products.image','products.price')//,'categories.id as category_table_id'
                        ->join('products','products.id','carts.product_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();

        //$subtotal = $this->calculateSubtotal($carts);
        $subtotal = Cart::where('user_id', Auth::user()->id)
                    ->sum('total');
        $tax = $this->getTax($subtotal);
        //$shipping = 3500;
        $total = $subtotal + $tax ;

        $countries = Country::all();

        return view('customer.checkout',compact('categories','carts','subtotal','tax','total','countries'));

    }

    public function create(Request $request){
        //dd($request->all());
       $this->getCheckoutData($request);
       $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
       if ($cartItems->isEmpty()) {
        return redirect()->route('customer#cart');
        } else {
       //dd($request->all());
        $subtotal = Cart::where('user_id', Auth::user()->id)
                    ->sum('total');
        $tax = $this->getTax($subtotal);
        //$shipping = 3500;
        $total = $subtotal + $tax ;


            // Create a new order instance
            $order = new Order();
            $order->customer_id = Auth::user()->id;
            if($request->companyName){
                $order->company_name = $request->companyName;
            }
            $order->shipping_country_id = $request->shippingCountry;
            $order->shipping_state_id = $request->shippingState;
            $order->shipping_township_id = $request->shippingTownship;
            $order->shipping_zip = $request->zip;
            $order->shipping_address = $request->shippingAddress;

            if($request->diffrentShippingCountry){
                $order->different_shipping_country_id = $request->diffrentShippingCountry;
            }

            if($request->diffrentShippingState){
                $order->different_shipping_state_id = $request->diffrentShippingState;
            }

            if($request->diffrentShippingTownship){
                $order->different_shipping_township_id = $request->diffrentShippingTownship;
            }

            if($request->diffrentShippingAddress){
                $order->different_shipping_address = $request->diffrentShippingAddress;
            }

            if($request->diffrentShippingPhone){
                $order->different_shipping_phone = $request->diffrentShippingPhone;
            }


            $order->payment_method = $request->payment;
            $order->total_amount = $total;
            $order->order_date = Carbon::now();
            if($request->order_note){
                $order->order_note = $request->order_note;
            }
            //$order->payment_status = $request->;
            $order->save();

            // Add the items from the user's cart to the order

            foreach ($cartItems as $cartItem) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cartItem->product_id;
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->price = $cartItem->product->price;
                $orderItem->save();

                // Remove the item from the user's cart
                $cartItem->delete();
            }
           // $orderid = $order->id;
           Mail::to(Auth::user()->email)->send(new OrderConfirmation($order));
           $order = Order::with('items')
                        ->with('customer')->with('shipping_country')->with('shipping_state')->with('shipping_township')
                        ->with('different_shipping_country')->with('different_shipping_state')->with('different_shipping_township')
                        ->findOrFail($order->id);

            // Send the confirmation email



            // Generate the PDF content using Dompdf
            $dompdf = new Dompdf();
            $html = view('admin.attachments.create_new_order_email_attachment', compact('order'));
            // Load the HTML content into Dompdf
            $dompdf->loadHtml($html,'UTF-8');
            //$dompdf->loadHtml('<h1>Attachment PDF Content</h1>');
            $dompdf->setPaper('A4');
            $dompdf->render();

            // Save the PDF to a storage disk
            $fileName = 'attachment_'. $order->customer_id . '_' . $order->id .'.pdf'; // Specify the desired file name
            Storage::disk('public')->put($fileName, $dompdf->output());

            // Get the full path to the PDF file
            $attachmentPath = storage_path('app/public/' . $fileName);

            Mail::to('nayzaw.aung@datalinkmm.com')->send(new NewOrderEmail($order, $attachmentPath));

            // Redirect to the confirmation page
            return redirect()->route('customer#confirmation',['orderid' => $order->id]);
        }

    }

    public function confirmation($orderid){
        $categories = Category::orderby('created_at','desc')->get();
        return view('customer.checkout-success', compact('orderid','categories'));
    }


    private function getTax($subtotal)
{
    return $subtotal * 0.01; // Replace with your own tax calculation
}

private function getCheckoutData($request){

    if ($request->has('diffrentShipping')) {

        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            //'companyName' => 'required|string|max:255',
            'shippingCountry' => 'required|string|max:255',
            'shippingState' => 'required|string|max:255',
            'shippingTownship' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'shippingAddress' => 'required|string|max:255',
            'payment' => 'required|string|max:255',
            //'pizzaImage.*' => ['mimes:jpeg,png,gif,jpg'],

            'diffrentShippingCountry' => 'required|string|max:255',
            'diffrentShippingState' => 'required|string|max:255',
            'diffrentShippingTownship' => 'required|string|max:255',
            'diffrentShippingAddress' => 'required|string|max:255',
            'diffrentShippingPhone' => 'required|string|max:255',

        ])->validate();

    }else{

        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            //'companyName' => 'required|string|max:255',
            'shippingCountry' => 'required|string|max:255',
            'shippingState' => 'required|string|max:255',
            'shippingTownship' => 'required|string|max:255',
            'zip' => 'required|string|max:10',
            'shippingAddress' => 'required|string|max:255',
            'payment' => 'required|string|max:255',
            //'pizzaImage.*' => ['mimes:jpeg,png,gif,jpg'],
        ])->validate();

    }

    // return [
    //     'customer_id' =>Auth::user()->id,
    //     'shipping_address' => $request->shipping_address,
    //     'shipping_city' => $request->shipping_city,
    //     'shipping_state' => $request->shipping_state,
    //     'shipping_zip' => $request->zip,
    //     'payment_method' => $request->payment,
    //     //'total_amount' => $request->,
    //     'order_date' => now(),
    //     //'order_note' => $request->,
    //     //'payment_status' => $request->,
    // ];
}



}
