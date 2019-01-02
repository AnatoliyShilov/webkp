<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'text' => 'required'
            ]
        );
        $newComment = new Comment;
        $newComment->text = $request->input('text');
        $newComment->product = $request->input('product');
        $newComment->user = $request->input('user');
        $newComment->save();
        return redirect('/products/' . $request->input('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect('/comments');
    }
}
