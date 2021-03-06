<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use SebastianBergmann\Environment\Console;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postCount= Cache::remember('posts.count.'.$user->id,now()->addSeconds(30),function()use($user){
            return $user->posts->count();
        }); 
        $follwersCount=Cache::remember('followers.count.'.$user->id,now()->addSeconds(30),function() use($user){
            return  $user->profile->Follwers->count();
        });
        $followingCount=Cache::remember('following.count.'.$user->id,now()->addSeconds(30),function() use($user){
            return $user->following->count();
        }); 
        //    $user=User::findOrFail($user);
        return view('profiles.index', compact('user', 'follows','postCount','follwersCount','followingCount'));
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', compact('user'));
    }
    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagepath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagepath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        // ddd($data);
        return redirect("/profile/{$user->id}");
    }
}
