@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <a href="{{route('posts.index')}}">Go back</a>
                <div class="card">
                <div class="card-header">{{$post->title}}</div>
    
                    <div class="card-body">
                     <p>{{$post->description}}</p>
                    <img src="{{asset('posts-images'.'/'.$post->image)}}"/>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection