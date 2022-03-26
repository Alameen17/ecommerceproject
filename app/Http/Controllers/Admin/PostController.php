<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function BlogCatList(){
        $blogcat = DB::table('post_category')->get();
        return view('admin.blog.category.index',compact('blogcat'));
    }

    public function StoreBlogCat(Request $request){
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
        ]);
        $data = array();
        $data['category_name'] = $request->category_name;
        DB::table('post_category')->insert($data);
        $notification=array(
            'messege'=>'Blog Category Inserted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function DeleteBlogCat($id){
        DB::table('post_category')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Blog Category Deleted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }

    public function EditBlogCat($id){

        $blogcatEdit = DB::table('post_category')->where('id',$id)->first();
        return view('admin.blog.category.edit',compact('blogcatEdit'));
    }

    public function UpdateBlogCat(Request $request, $id){
        $validateData = $request->validate([
            'category_name' => 'required|max:255',
        ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $update=DB::table('post_category')->where('id',$id)->update($data);

        if($update){
            $notification=array(
                'messege'=>'Blog Category Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('add.blog.categorylist')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Error Occured!',
                'alert-type'=>'error'
                 );
               return Redirect()->route('add.blog.categorylist')->with($notification);
        }
    }

    public function Create(){
        $blogcategory = DB::table('post_category')->get();
        return view('admin.blog.create',compact('blogcategory'));
    }

    public function store(Request $request){

        $data=array();
        $data['category_id'] = $request->category_id;
        $data['post_title'] = $request->post_title;
        $data['post_image'] = $request->post_image;
        $data['details'] = $request->details;
        

        $image = $request->post_image;

        if($image){
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('public/media/blog/'.$image_name);
            $data['post_image'] = 'public/media/blog/'.$image_name;

            $product = DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Blog Post Inserted Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all.blogpost')->with($notification);
        }

    }

    public function index(){

        $blogpost = DB::table('posts')
        ->join('post_category','posts.category_id','post_category.id')
        ->select('posts.*','post_category.category_name')
        ->get();

        return view('admin.blog.index',compact('blogpost'));

    }

    public function EditBlogPost($id){
        $blogpostEdit = DB::table('posts')->where('id',$id)->first();
        return view('admin.blog.edit',compact('blogpostEdit'));
    }

    public function UpdateBlogWithoutImage(Request $request, $id){

        $data=array();
        $data['category_id'] = $request->category_id;
        $data['post_title'] = $request->post_title;
        $data['details'] = $request->details;

        $update = DB::table('posts')->where('id',$id)->update($data);

        if ($update) {
            $notification=array(
                'messege'=>'Blog Post Updated Successfully',
                'alert-type'=>'info'
                 );
               return Redirect()->route('all.blogpost')->with($notification);
        }else{
            $notification=array(
                'messege'=>'Error Occured!',
                'alert-type'=>'error'
                 );
               return Redirect()->route('all.blogpost')->with($notification);
        }
    }

    public function UpdateBlogWithImage(Request $request, $id){

        $old_one = $request->old_one;

        $data=array();
        $image = $request->post_image;

        if($image){
            unlink($old_one);
            $image_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300,300)->save('public/media/blog/'.$image_name);
            $data['post_image'] = 'public/media/blog/'.$image_name;

            $product = DB::table('posts')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Blog Post Updated Successfully',
                'alert-type'=>'success'
                 );
               return Redirect()->route('all.blogpost')->with($notification);
        }

    }

    public function DeleteBlogPost($id){
        $post = DB::table('posts')->where('id',$id)->first();
        $image = $post->post_image;
        unlink($image);

        DB::table('posts')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Blog Post Deleted Successfully',
            'alert-type'=>'success'
             );
           return Redirect()->back()->with($notification);
    }
}


