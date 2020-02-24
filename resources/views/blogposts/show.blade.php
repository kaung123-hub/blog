@extends('layouts.master')
@section('title','View Post')
@section('content')
<br>
<div class="container">
    @if(session()->has('status2'))
        <div class="col-md-12">
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                <strong>Congratulations ..!</strong>{{session()->get('status2')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <h4 class="display-4 my-3">{{$post->title}}</h4>
    <p class="text-danger mb-4">(author-{{$post->author}}) (view-{{$post->view-1}})</p>

    <p>{{$post->content}}</p>
 
    @if(Auth::user())
    <form class="form-inline" action="{{url('comments')}}" method="POST" role="form">
    @csrf
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input class="form-control mx-3" name="content" style="width: 90%" type="text" placeholder="Your comments" />
        <button class="btn btn-primary float-right" type="submit">Send</button>
    </form><br>

    <div class="card px-3 py-3 bg-light">
        @foreach($post->comments as $comment)
            <span class="text-danger" style="float:left; width:50%">{{$comment->user->name}}</span>
            <span class="text-primary" style="float:right; width:50%"><i class="fa fa-clock-o text-primary" style="font-size:20px;"></i> {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
            <input type="text" class="form-control" value="{{$comment->content}}" readonly><br>
        @endforeach
    </div>

    @if(Auth::user()->role->name == 'Admin')
    <form action="{{url('blog-posts/'.$post->id)}}" method="post">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="float-left btn btn-danger mt-4 mx-3" name="button">Delete</button>
    </form>
    <a href="{{route('blog-posts.edit',['blog_post'=>$post->id])}}" class="btn btn-info mt-4 mr-5">Edit</a>
    @endif
    @endif

    <a href="{{url('blog-posts')}}" class="btn btn-success float-right  mt-4">Back</a>

</div>


@endsection
