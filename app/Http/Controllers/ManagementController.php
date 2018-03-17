<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Tag;
use App\Post;
use App\Category;
use App\Comment;
use Auth;

class ManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('managements.index');
    }

    public function users()
    {
        $users = User::all();
        return view('managements.users')->with('users', $users);
    }

    public function tags()
    {
        $tags = Tag::all();
        return view('managements.tags')->with('tags', $tags);
    }

    public function posts()
    {
        $posts = Post::all();
        return view('managements.posts')->with('posts', $posts);
    }

    public function categories()
    {
        $categories = Category::all();
        return view('managements.categories')->with('categories', $categories);
    }

    public function comments()
    {
        $comments = Comment::all();
        return view('managements.comments')->with('comments', $comments);
    }

    public function user_kill($id)
    {
        if ( Auth::user()->hasRole('admin') ) {
            $user = User::find($id);
            $user->roles()->detach();
            foreach ( $user->posts as $post ) {
                $post->tags()->detach();
                $post->comments()->delete();
            }
            $user->posts()->delete();
            $user->comments()->delete();
            $user->delete();
            return redirect('/manage/users')->with('success', 'Пользователь удалён');
        }

        return redirect('/manage/users')->with('message', 'Недостаточно прав');
    }

    public function user_roleChange(Request $request, $id)
    {
        if ( Auth::user()->hasRole('admin') ) {
            $user = User::find($id);
            $role = $user->roles()->where('user_id', $id)->first();
            $role->pivot->role_id = $request->new_role;
            $role->pivot->save();

            return redirect('/manage/users')->with('success', 'Роль изменена');
        }
        
        return redirect('/manage/users')->with('message', 'Недостаточно прав');
    }
}
