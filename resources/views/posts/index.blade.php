@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2>Posts</h2>
                            </div>
                            @if (Auth::user()->roles()->where('name','Admin')->orWhere('name','Editor')->first())
                            <div class="col-md-6">
                                    <button type="button" style="float:right;" class="btn btn-primary" data-toggle="modal" data-target="#addPost">
                                            Add Post
                                    </button>
                            </div>
                            @endif
                          
                        </div>
                    </div>

                    <div class="card-body">
                            <table class="table">
                                    <caption>List of Posts</caption>
                                    <thead>
                                      <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $p)
                                      <tr>
                                      <th scope="row">{{$loop->iteration}}</th>
                                      <td>{{$p->title}}</td>
                                      <td>{{str_limit($p->description,40)}}</td>
                                        <td>
                                        <a href="{{URL::to('posts'.'/'.$p->slug)}}" class="btn btn-success btn-xs">View</a>
                                        @if (Auth::user()->roles()->where('name','Editor')->orWhere('name','Admin')->first())
                                        <a href="{{URL::to('posts/edit'.'/'.$p->slug)}}" class="btn btn-primary btn-xs">Edit</a>
                                        @endif
                                        @if (Auth::user()->roles()->where('name','Admin')->first())
                                        <a id="delete-{{$p->id}}" class="btn btn-danger btn-xs">Delete</a>
                                        @endif
                                        </td>
                                      </tr>
                                   @endforeach
                                    </tbody>
                                  </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!-- Modal -->
      <div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
            <form method="POST" enctype="multipart/form-data" action="{{route('posts.store')}}">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" name="title" placeholder="Input title of the post"/>
                    </div>
                     <div class="form-group">
                        <label for="title">Description</label>
                       <textarea class="form-control" rows="10" cols="20" name="description"></textarea>
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
              </div>
            </div>
          </div>
@endsection

      
    
@section('js')
<script>
$(document).on('click',"[id*='delete-']",function(event){
    var id = $(this).attr("id").slice(7);
swal({
                title: "Are you sure?",
                text: "You will not be able to recover this file!",
                type: "warning",
                showCancelButton: true,
              }).then(function(){
                $.post("{{route('posts.delete')}}",{id:id,_token:"{{csrf_token()}}"},function(data){
                  swal({
                    title:"Deleted Successfully",
                    type:"success"
        
                  }).then(function(){
                    window.location.href = "{{URL::to('/posts')}}";
                  })
                })
              });
});
</script>
@endsection