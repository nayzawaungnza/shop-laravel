<?php

namespace App\Http\Controllers;

use App\Models\Order;
//use App\Models\Comment;
use App\Models\Review;
use App\Models\Product;
//use Illuminate\Support\Facades\DB;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function index(){
    //     $reviews = Review::leftJoin('comments', 'reviews.id', '=', 'comments.review_id')
    // ->select(
    //     'reviews.id',
    //     DB::raw('IFNULL(reviews.customer_id, comments.customer_id) AS customer_id'),
    //     DB::raw('IFNULL(reviews.product_id, comments.product_id) AS product_id'),
    //     DB::raw('IFNULL(reviews.created_at, comments.created_at) AS created_at'),
    //     'reviews.rating',
    //     'reviews.comment',
    //     'comments.comment AS comment_comment'
    // )
    // ->unionAll(
    //     Comment::leftJoin('reviews', 'comments.review_id', '=', 'reviews.id')
    //         ->select(
    //             'reviews.id',
    //             DB::raw('NULL AS customer_id'),
    //             DB::raw('NULL AS product_id'),
    //             DB::raw('NULL AS created_at'),
    //             'comments.comment',
    //             'comments.created_at AS comment_created_date',
    //             'comments.comment AS comment_comment',
    //             'comments.customer_id AS comment_customer_id',
    //             'comments.product_id AS comment_product_id'
    //         )
    //         ->whereNull('reviews.id')
    //         ->orWhere('product_id', $product->id)
    // )
    // ->with('customer')
    // ->get();



        return view('admin.reviews.index',compact('reviews'));

    }

    //For Customer
    public function storeReview(Request $request, $id, Product $product)
    {

        //$product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // 'rating' => 'required_without_all:comment',
            // 'comment' => 'required_without_all:rating',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:500',
        ], [
            // 'rating.required_without_all' => 'The rating field is required when the comment is empty.',
            // 'comment.required_without_all' => 'The comment field is required when the rating is empty.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $product = Product::findOrFail($id);

        $customer = Auth::user();
        //dd($customer->toArray());
        //$order = $customer->orders()->items()->where('product_id', $product->id)->first();
        $order = $customer->orders()->with('items')
                            //->where('status', 'completed')
                            ->whereIn('status', ['completed', 'shipped', 'delivered'])
                            ->whereHas('items', function ($query) use ($product) {
                            $query->where('product_id', $product->id);
                        })->first();

        // $order = DB::table('orders')
        // ->join('order_items', 'orders.id', '=', 'order_items.order_id')
        // ->whereIn('orders.status', ['complete', 'shipped', 'delivered'])
        // ->where('order_items.product_id', $product->id)
        // ->where('orders.customer_id', $customer->id)
        // ->select('orders.*')
        // ->first();

        // $order= Order::where('customer_id',$customer->id)
        //                 ->whereIn('status', ['completed', 'shipped', 'delivered'])
        //                 ->with('items')
        //                 ->whereHas('items', function ($query) use ($product) {
        //                                         $query->where('product_id', $product->id);
        //                                     })
        //                 ->first();

        //dd($order->toArray());

        if (!$order) {
            return redirect()->back()->with('error', 'You can only review products you have purchased.');
        }

        // Validation passed, proceed with storing the review

        $review = new Review();
        $review->product_id = $id;
        $review->customer_id = Auth::id();
        if($request->input('rating')){
            $review->rating = $request->input('rating');
        }
        if($request->input('review')){
            $review->comment = $request->input('review');
        }


        // You may also set other properties of the review if necessary

        // Save the review
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }

    //Comment Delete
    public function destroy(Review $review, $id)
    {
        //dd($id);
        $review = Review::FindOrFail($id);
        //dd($review->toArray());
        //dd($review->customer_id , auth()->user()->id);
        if (auth()->user() && $review->customer_id == auth()->user()->id) {
            $review->delete();
            return redirect()->back()->with('delete', 'Comment deleted successfully!');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    //Comment Like
    // public function like(Request $request, Review $review)
    // {
    //     // Check if the user has already liked the comment
    //     $existingLike = CommentLike::where('customer_id', Auth::id())->where('comment_id', $review->id)->first();

    //     if ($existingLike) {
    //         // User has already liked the comment, you can handle this scenario accordingly
    //         return redirect()->back()->with('error', 'You have already liked this comment.');
    //     }

    //     // Create a new like record
    //     $like = new CommentLike();
    //     $like->customer_id = Auth::id();
    //     $like->comment_id = $review->id;
    //     $like->save();

    //     // Redirect back or do any other necessary action
    //     return redirect()->back()->with('success', 'Comment liked!');
    // }




}
