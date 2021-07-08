@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-3 p-5">
        <img src="{{$user->profile->profileImage()}}" class="rounded-circle" alt="profile image" style="max-width:200px">
        </div>
        <div class="col-9 p-5">
            <div class="d-flex justify-content-between align-items-baseline "> {{-- //we have given the class at the time of Add a post. --}} 
                <div class='d-flex align-items-center pb-3'>
                    <div class="h4">{{$user->username}} </div>
                    <div id="followButton" user_id="{{ $user->id }}" follows="{{ $follows }}"></div>
                </div>
                
                @can('update', $user->profile)
                <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
            <a href="/profile/{{$user->id}}/edit">Edit Profile </a>
            @endcan
            <div class="d-flex">
            <div class="pr-4"><strong class="pr-1">{{ $user->posts->count() }}</strong>posts</div>
            <div class="pr-4"><strong class="pr-1">23k</strong>followers</div>
            <div class="pr-4"><strong class="pr-1">212</strong>following</div>        
            </div>
            <div class="pt-4 font-weight-bold"> {{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="/">{{ $user->profile->url }}</a></div>
                    
        </div>
    </div>
    <div class="row pt-4 ">
        @foreach ($user->posts as $posts )
        <div class="col-4 pb-4">
            <a href="/p/{{$posts->id }}">
                <img src="/storage/{{$posts->image}}" alt="insta-img" class="w-100">
            </a>          
        </div>    
        @endforeach
        
        
        
    </div>
</div>


@endsection
