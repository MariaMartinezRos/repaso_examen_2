<?php

namespace App\Http\Controllers\Api\V3;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $comment = new Comment();
        $comment->product_id = $product->id;
        $comment->content = $request->input('content');
        $comment->save();

        return response()->json($comment, 201);
    }

    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $comments = $product->comments;

        return response()->json($comments);
    }
}
