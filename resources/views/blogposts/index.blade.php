@extends('layouts.master')
@section('title','Blog Posts')
@section('content')

  <br>
   <div class="container">
    <a class="btn btn-danger float-right text-light" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Subscribe</a><br><br>
    @if(session()->has('status'))
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations ..!</strong> {{session()->get('status')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
    
    @elseif(session()->has('status4'))
      <div class="col-md-12">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations ..!</strong> {{session()->get('status4')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>
      </div>
    @endif
     <div class="row">
       @forelse ($blogposts as $blogpost)
       <div class="card col-sm-3.8 mx-3 my-3" style="width: 18rem;">
         <div class="card-body">
           <h5 class="card-title">
           {{$blogpost->title}}
           </h5>
           <h6 class="card-subtitle mb-2 text-muted">
           author-({{$blogpost->author}})
           </h6>
           <h6 class="card-subtitle mb-2 text-primary float-right">
           {{\Carbon\Carbon::parse($blogpost->created_at)->diffForHumans()}}
           </h6>
           <p class="card-text">
             {{implode(' ',array_slice(explode(' ',$blogpost->content),0,15))}}...
           </p>
           <a href="#" class="card-link btn btn-warning">View -({{$blogpost->view}})</a>
           <a href="{{route('blog-posts.show',['blog_post'=>$blogpost->id])}}" class="card-link btn btn-primary float-right">Read More..</a>
         </div>
       </div>
       <br> <br>
       @empty

       <div class="jumbotron col-md-12">
         <h1 class="display-4">No Data Avaiable Now..!</h1>
         <p class="lead text-info mt-5">You can be star author</p>
         <hr class="my-4">
         <a class="btn btn-success float-right mt-5" href="{{route('blog-posts.create')}}" role="button">Create Posts</a>
       </div>

       @endforelse
       {{ $blogposts->links() }}
     </div>
   </div>

   <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Subscribe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @if($errors->any())
                @foreach ($errors->all() as $error)
                <p class="text-danger">{{$error}}</p>
                @endforeach
          @endif

            <form action="{{url('subscribers')}}" method="POST">
              @csrf

            <div class="form-group row">
              <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm text-primary">Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control form-control-sm" id="colFormLabelSm" name="name" placeholder="Enter Your Name" value="{{old('name')}}" >
              </div>
            </div>
            <div class="form-group row">
              <label for="colFormLabel" class="col-sm-2 col-form-label text-primary">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="colFormLabel" name="email" placeholder="Enter Your Email" value="{{old('email')}}">
              </div>
            </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" value="subscribe" class="btn btn-primary">
          </div>
        </form>
      </div>
    </div>
  </div>


@endsection