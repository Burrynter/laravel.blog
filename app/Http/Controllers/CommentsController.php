<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);
 
        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'post_id' => $post->id
        ]);
        return redirect()->route('post', [$post->category, $post->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post = Post::findOrFail($comment->post_id);

        // Является ли текущий пользователь автором или модератором/админом
        if(Auth::user()->id !== $comment->user_id && !(Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))){
            return redirect()->route('post', [$post->category->slug, $post->slug])->with('error', 'Вы не являетесь автором этого комментария');
        }

        $comment->delete();
        return redirect()->route('post', [$post->category->slug, $post->slug])->with('success', 'Комментарий удалён');
    }
}
