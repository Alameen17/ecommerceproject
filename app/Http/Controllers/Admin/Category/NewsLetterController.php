<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class NewsLetterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function NewsLetters(){
        $sub = DB::table('newsletters')->get();
        return view('admin.coupon.newsletter',compact('sub'));
    }

    public function DeleteSub($id){
        DB::table('newsletters')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Email Subscriber Deleted Succesfully!',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification); 
    }
}
