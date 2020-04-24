<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
     public function send()
     {
         
         Mail::send(['text'=>'mail'], ['name'=>'web dev blog'], function ($message){
            $message->to('resintegra78@gmail.com', 'Джон Смит')->subject('Привет!');
            $message->from('resintegra78@gmail.com', 'Laravel');
         });
     }

     public function email()
     {
         return view('email');
     }
}
