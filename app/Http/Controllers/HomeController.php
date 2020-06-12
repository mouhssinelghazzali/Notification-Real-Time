<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\NewNotification;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with(['comments' => function($q){
            $q -> select('id','post_id','comment');
        }])->get();
        return view('home',compact('posts'));
    }

    public function save(Request $request)
    {
        $data = [
            'post_id' => $request->post_id ,
            'user_id' => Auth::id(),
            'comment' => $request->post_content,
        ];
        Comment::create($data);
        
        
        event(new NewNotification($data));
            
        return redirect()->back()->with(['success' => 'avec success']);
    }
}
