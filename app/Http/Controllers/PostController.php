<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        //All the routs stated below are now protected with auth
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        dd($users);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required', 'image']
        ]);
        //data will be stored in the data variable after validation so we can simply pass to the Moel and create query will be helpful there
        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        // dd($imagePath);
        return redirect('/profile/' . auth()->user()->id);
    }
    public function show(Post $post)
    {
        return view('posts/show', compact('post'));
    }
}
