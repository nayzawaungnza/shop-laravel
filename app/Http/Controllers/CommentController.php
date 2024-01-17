<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Models\CommentLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function storeComment(Request $request, $id)
    {

        $product = Product::findOrFail($id);

        $validator = Validator::make($request->all(), [
            // 'rating' => 'required_without_all:comment',
            // 'comment' => 'required_without_all:rating',
            'comment' => 'required|string',
        ], [
            // 'rating.required_without_all' => 'The rating field is required when the comment is empty.',
            // 'comment.required_without_all' => 'The comment field is required when the rating is empty.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validation passed, proceed with storing the review

        $comment = new Comment();
        $comment->product_id = $id;
        $comment->customer_id = Auth::id();
        // if($request->input('rating')){
        //     $comment->rating = $request->input('rating');
        // }
        if($request->input('comment')){
            $comment->comment = $request->input('comment');
        }


        // You may also set other properties of the comment if necessary

        // Save the comment
        $comment->save();

        return redirect()->route('customer#productdetail', $product->slug)->with('success', 'Review submitted successfully.');
    }

    public function destroy(Comment $comment, $id)
    {
        //dd($id);
        $comment = Comment::FindOrFail($id);
        //dd($comment->toArray());
        //dd($comment->customer_id , auth()->user()->id);
        if (auth()->user() && $comment->customer_id == auth()->user()->id) {
            $comment->delete();
            return redirect()->back()->with('delete', 'Comment deleted successfully!');
        }

        return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
    }

    public function like(Request $request, Comment $comment)
    {
           //Log::info('Request Data:', ['data' => $request->all()]);


           // Check if the user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }



        // Create a new like for the comment
        // $comment->likes()->create([
        //     'customer_id' => $request->customerId,
        //     'comment_id' => $request->commentId,
        // ]);

        $like = new CommentLike();
        $like->customer_id = $request->customerId;
        $like->comment_id = $request->commentId;
        $like->save();

        // Get the updated like count
        //$likeCount = $comment->likes()->count();

        $likeCount = CommentLike::where('comment_id',$request->commentId)->count();

        //logger($likeCount);
        return response()->json(['message' => 'Comment liked', 'likeCount' => $likeCount], 200);


    // $like_count = Review::select('*', DB::raw('(
    //     SELECT COUNT(*) FROM comment_likes WHERE comment_likes.review_id = reviews.id
    // ) as likes_count'))
    // ->get();

    //     return response()->json([
    //         'likes' => $like_count
    //     ]);
    }

    public function unlike(Request $request, Comment $comment)
    {
        // Check if the user is authenticated
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Check if the user has already liked the comment
        if (CommentLike::where('customer_id', $request->customerId)->where('comment_id', $request->commentId)->exists()) {
            CommentLike::where('customer_id', $request->customerId)->where('comment_id', $request->commentId)->delete();
        }

        $likeCount = CommentLike::where('comment_id',$request->commentId)->count();

        return response()->json(['message' => 'Comment like deleted successfully', 'likeCount' => $likeCount], 200);


    }
    public function storeReply(Request $request, $productId, $commentId,Comment $comment){

        // Validate the request data
        $request->validate([
            'reply_content' => 'required',
            'customer_id' => 'required',
            //'parent_id' => 'required',
        ]);

        //dd($request->all(),$productId, $commentId);

        $reply = new Comment();
        $reply->parent_id = $commentId;
        $reply->customer_id = $request->customer_id;
        $reply->product_id = $productId;
        $reply->comment = $request->reply_content;
        $reply->save();

        return redirect()->back()->with('success', 'Reply comment stored successfully');

    }

}
