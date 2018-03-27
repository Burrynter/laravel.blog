<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Auth;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('tags.index')->with('tags', $tags);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::whereSlug($slug)->firstOrFail();

        $perPage = 6;
        $posts = $tag->posts()->where('published', true)->get();
        if (count($posts) > $perPage) {
            $pages = true;
            $posts = $tag->posts()->where('published', true)->paginate($perPage);
        } else {
            $pages = false;
        }

        return view('tags.show')->with(['tag' => $tag, 'posts' => $posts, 'pages' => $pages]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->hasRole('admin')) {
            $tag = Tag::find($id);
            
            return view('tags.edit')->with('tag', $tag);
        }
        return redirect()->route('/tags')->with('error', 'Недостаточно прав');
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
            'name' => 'required|max:225',
            'slug' => 'required|max:225'
        ]);

        // Найти тэг
        $tag = Tag::find($id);

        $tag->name = $request->input('name');
        $tag->slug = $request->input('slug');
        $tag->save();

        return redirect('manage/tags/')->with('success', 'Тэг изменён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ( Auth::user()->hasRole('admin') ) {
        
            $tag = Tag::find($id);
            $tag->posts()->detach();
            $tag->delete();
            
            return redirect('/manage/tags')->with('success', 'Тэг удалён');
        }

        return redirect('/manage/tags')->with('success', 'Недостаточно прав');
    }
}
