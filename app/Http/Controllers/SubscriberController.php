<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subscriber;

use App\BlogPost;

use App\Http\Requests\StoreSubscriber;

use Mail;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmation()
    {
        return view('mail_confirmation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmationEmail()
    {
        return ("COnfirmation successful!!");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $subscriber = Subscriber::where('email','=',$request->email)->first();
        if($subscriber === null){

            //Avaliable alphamatic characters
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            //generate a pin based on 2 digits + a random character

            $pin = mt_rand(10,99)
                    .$characters[rand(0,strlen($characters)-1)]
                    .mt_rand(10,99)
                    .$characters[rand(0,strlen($characters)-1)];

            $confirmation_code = str_shuffle($pin);

            Subscriber::create(['name'=>$request->name,'email'=>$request->email,'confirmation_code'=>$confirmation_code]);

            session()->flash('status4','Please Check Your Email Inbox to Varify');
            $data = array('name'=>'Blog Application','username'=>$request->name,'email'=>$request->email,'confirmation_code'=>$confirmation_code);
            Mail::send('subscribe_mail',$data,function($message) use ($request){
                $message->to($request->email,$request->name)->subject
                ('Subscriber Created Mail');
                $message->from('hyugoyabuto@gmail.com','Blog Application');
            });
            return redirect()->route('blog-posts.index');
        }
        else{
            session()->flash('status','Your email is already subscribed');
            return redirect()->route('blog-posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
