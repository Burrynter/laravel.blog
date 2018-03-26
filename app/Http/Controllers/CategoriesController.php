<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('admin')) {
            return view('categories.create');
        }
        return redirect()->route('categories')->with('error', 'Недостаточно прав');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
            $this->validate($request, [
                'name'=>'required|max:225',
                'desc' => 'required'
            ]);

            $category = new Category;

            if ($category) {
                $category->name = $request->input('name');
                $category->desc = $request->input('desc');
                $category->save();
            }
            return redirect()->route('manage.categories')->with('success', 'Категория создана');
        }

        return redirect()->route('categories')->with('error', 'Недостаточно прав');
    }

    /**
     * Display the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::whereSlug($slug)->firstOrFail();
        return view('categories.show')->with('category', $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        if (Auth::user()->hasRole('admin')) {
            $category = Category::whereSlug($slug)->firstOrFail();
            
            return view('categories.edit')->with('category', $category);
        }
        return redirect()->route('categories')->with('error', 'Недостаточно прав');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        if (Auth::user()->hasRole('admin')) {
            
            $this->validate($request, [
                'name' => 'required|max:225',
                'desc' => 'required',
                'slug' => 'required|max:225'
            ]);

            $category = Category::whereSlug($slug)->firstOrFail();

            if ($category) {
                $category->name = $request->input('name');
                $category->desc = $request->input('desc');
                $category->slug = $request->input('slug');
                $category->save();
            }
            return redirect()->route('category', $category->slug)->with('success', 'Категория изменена');
        }
        return redirect()->route('categories')->with('error', 'Недостаточно прав');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('admin')) {
            $category = Category::find($id);
            foreach ( $category->posts as $post ) {
                $post->tags()->detach();
                $post->comments()->delete();
            }
            $category->posts()->delete();
            $category->delete();

            return redirect()->route('manage.categories')->with('success', 'Категория удалена');
        }

        return redirect()->route('categories')->with('error', 'Недостаточно прав');
    }
}
