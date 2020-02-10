<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class MailController extends Controller
{
    public function basic_email() {
        $data = array('name'=>"Blog Application");

        Mail::send(['text'=>'mail'], $data, function($message) {
        $message->to('kaunghtetsoe6101997@gmail.com', 'Kaung')->subject
        ('Basic Testing Mail');
        $message->from('hyugoyabuto@gmail.com','Blog Application');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

        public function html_email() {
        $data = array('name'=>"Blog Application");
        Mail::send('mail', $data, function($message) {
        $message->to('hyugoyabuto@gmail.com', 'Zwel')->subject
        ('HTML Testing Mail');
        $message->from('hyugoyabuto.com','Blog Application');
        });
        echo "HTML Email Sent. Check your inbox.";
        }
}
