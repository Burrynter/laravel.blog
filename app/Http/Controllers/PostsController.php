<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\Comment;
use Auth;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(6);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $catList = [];
        foreach($categories as $category){
            $catList[$category->id] = $category->name;
        }
        return view('posts.create')->with('categories', $catList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title'=>'required|max:225',
            'body' => 'required',
            'category' => 'required'
          ]);
        
        // Создать пост
        $post = new Post;
        
        if ($post) {        
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->category_id = $request->input('category');
            
            $tags = $request->get('tags');
            if ($tags) {
                $tagNames = explode(', ', $request->get('tags'));
                $tagIds = [];
                foreach($tagNames as $tagName){
                    if ($tagName) {
                        $tag = Tag::firstOrCreate(['name' => $tagName ]);
                        if($tag){
                            $tagIds[] = $tag->id;
                        }
                    }   
                }
                $post->save();
                $post->tags()->sync($tagIds);
            }
            else $post->save();
        }
        
        return redirect()->route('post', ['category' => $post->category->slug, 'post' => $post->slug])->with('success', 'Пост создан');
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $category
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($category, $slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  str  $category
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($category, $slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        
        // Является ли текущий пользователь автором или модератором/админом
        if(Auth::user()->id !== $post->user_id && !(Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))){
            return redirect('/posts')->with('error', 'Вы не являетесь автором этого поста');
        }
        
        $categories = Category::all();
        $catList = [];
        foreach($categories as $category){
            $catList[$category->id] = $category->name;
        }

        return view('posts.edit')->with('data', ['post' => $post, 'categories' => $catList]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:225',
            'body' => 'required'
        ]);

        // Найти пост
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        if (($request->input('category')) && (Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))) {
            $post->category_id = $request->input('category');
        }
        
        $tags = $request->get('tags');
        if ($tags) {
            $tagNames = explode(', ', $request->get('tags'));
            $tagIds = [];
            foreach($tagNames as $tagName){
                if ($tagName) {
                    $tag = Tag::firstOrCreate(['name' => $tagName ]);
                    if($tag){
                        $tagIds[] = $tag->id;
                    }
                }   
            }
            $post->save();
            $post->tags()->sync($tagIds);
        }
        else $post->save();
        
        return redirect()->route('post', ['category' => $post->category->slug, 'post' => $post->slug])->with('success', 'Пост изменён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Является ли текущий пользователь автором или модератором/админом
        if(Auth::user()->id !== $post->user_id && !(Auth::user()->hasRole('moderator') || Auth::user()->hasRole('admin'))){
            return redirect()->route('category', ['category' => $post->category->slug])->with('error', 'Вы не являетесь автором этого поста');
        }
        
        $post->tags()->detach();
        Comment::where("post_id", $post->id)->delete();

        $post->delete();
        return redirect()->route('category', ['category' => $post->category->slug])->with('success', 'Пост удалён');
    }
}
