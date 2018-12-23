@extends('layouts.app')
@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>History Log</h2>
                            </div>
                            <div class="col-md-6">
                                <a style="float:right;" href="{{route('posts.index')}}">Go back</a>
                                </div>
                            </div>
                        </div>
                    <ul style="padding:10px;">
                        <div class="container">
                    @foreach($histories as $h)
                    <li style="padding:10px;">{{$h->user_name}} {{$h->activity}} </li>
                    @endforeach
                        </div>
                    </ul>
            
                </div>
            </div>
        </div>
    </div>
    
@endsection