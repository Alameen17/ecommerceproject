<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
{
    public function blog(){
    	$post = DB::table('posts')
		->join('post_category','posts.category_id','post_category.id')
		->select('posts.*','post_category.category_name')
		->get();
		//return response()->json($post);
		return view('pages.blog',compact('post'));
    }

    public function BlogSingle($id){
        $posts = DB::table('posts')->where('id',$id)->get();
        return view('pages.blog_single',compact('posts'));
  
    }
}
