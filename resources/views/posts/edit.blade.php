@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
<form method="POST" enctype="multipart/form-data" action="{{route('posts.update')}}">
    <div class="modal-body">
        @csrf
        <div class="form-group">
          <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{$post->title}}" placeholder="Input title of the post"/>
        </div>
    <input type="hidden" value="{{$post->id}}" name="id"/>
         <div class="form-group">
            <label for="title">Description</label>
         <textarea class="form-control" rows="10" name="description" cols="20">{{$post->description}}</textarea>
        </div>
        <div class="form-group">
                <label for="title">Image</label>
                <input type="file" class="form-control-file" name="image">
        </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
            </div></div></div>
@endsection