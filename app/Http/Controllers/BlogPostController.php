<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use App\BlogPost;
use App\Subscriber;
use Illuminate\Support\Facades\DB;
use Mail;
class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blogposts=BlogPost::all();
        $blogposts = BlogPost::paginate(9);// with schema
        // $blogposts = DB::table('blog_posts')->paginate(9);// with db table
        return view('blogposts.index',['blogposts'=>$blogposts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blogposts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {

      // $blogPost= new BlogPost;
      // $blogPost->title=$request->title;
      // $blogPost->author=$request->author;
      // $blogPost->content=$request->content;
      // $blogPost->view=0;
      // $blogPost->save();
      $users = Subscriber::all();
      BlogPost::create(['title'=>$request->title,'author'=>$request->author,'content'=>$request->content]);
      session()->flash('status','New posts is created.');
      $id = DB::table('blog_posts')->orderBy('created_at','desc')->first();
      $data = array('name'=>"Blog Application",'author'=>$request->author,'content'=>$request->content,'title'=>$request->title,'id'=>$id->id);
      foreach($users as $user){
      Mail::send('mail', $data, function($message) use($user){
      $message->to($user->email, $user->name)->subject
      ('Post Created Mail');
      $message->from('hyugoyabuto@gmail.com','Blog Application');
      });
      }
      return redirect()->route('blog-posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $blogPost=BlogPost::find($id);
      BlogPost::where('id',$id)->update(['view'=>$blogPost->view+1]);
        return view('blogposts.show',['post'=>BlogPost::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return view('blogposts.edit',['post'=>BlogPost::find($id)]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $blogUpdate = BlogPost::find($id);
        BlogPost::where('id',$id)->update(['title'=>$request->title,'author'=>$request->author,'content'=>$request->content]);
        session()->flash('status2','The '.$blogUpdate->author.' of '.$blogUpdate->title.' is updated.');
        return redirect()->route('blog-posts.show',['blog_post'=>$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blogPost = BlogPost::find($id);
        session()->flash('status3','The '.$blogPost->author.' of '.$blogPost-> title.' is deleted.');
        $blogPost->delete();
        return redirect()->route('blog-posts.index');
    }
}
