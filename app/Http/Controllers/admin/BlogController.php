<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Post;

class BlogController extends Controller
{
    //
    public function index(){
        return view('admin.blog.post');
    }
   public function store(Request $request){
    $rules = [
        'title' =>'required',
        'content' =>'required',
        'name' =>'required',
        'date' =>'required',
        'image' =>'required',
    ];
    
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
      $post = new Post();
      $post->title = $request->title;
      $post->content = $request->content;
      $post->name = $request->name;
      $post->date = $request->date;

      $post->post_status = 'active';

      /*if($request->image != ""){
      $image= $request->image;
      $imgname=time().'.'.$image->getOriginalClientExtension();
      $request->image->move(public_path('uploads/blog'),$imgname);
      $post->image=$imgname;
     
      }*/
     
      if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imgname = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/blog'), $imgname);
    
        $post->image = $imgname;
      

        $post->save();
    }
   
    
      return redirect()->route('blog.list')->with('success', 'Post created successfully');
   }
    public function list(){ 
        $post = Post::all();
        return view('admin.blog.show',compact('post'));
    }
   public function delete($id){
     $post = Post::findOrFail($id);
     $post->delete();
     return redirect()->route('blog.list')->with('success','post deleted successfully');

   }
   public function edit($id){
    $post=Post::findOrFail($id);
    return view('admin.blog.edit',compact('post'));
   }
  
   public function update($id,Request $request){
    $post = Post::findOrFail($id);
    $rules = [
      'title' =>'required',
      'content' =>'required',
      'name' =>'required',
      'date' =>'required',


  ];
  $validator = Validator::make($request->all(),$rules);
  if($validator->fails()){
      return redirect()->route('blog.edit',$post->id)->withInput()->withErrors($validator);
  }
      $post->title =$request->title;
      $post->content =$request->content;
      $post->name =$request->name;
      $post->date =$request->date;

      $post->save();

      if($request->image != "") {
    
        File::delete(public_path('uploads/blog',$post->image));


        $image = $request->file('image');
        $imgname = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/blog'), $imgname);
        $post->image = $imgname;
        
    }
    $post->save();
      return redirect()->route('blog.list')->with('success','post updated successfully');
      
   }
   public function home(){
    $posts = Post::all(); 
        return view('admin.blog.index',compact('posts'));
   }
  

  
   public function show($id){
    
    $post= Post::findOrFail($id);
    
    return view('admin.blog.showPost',compact('post'));
   }
   public function about(){
    return view('admin.blog.about');
   }
 public function service(){
    $posts = Post::all(); 
    return view('admin.blog.services', compact('posts'));
}


 }
 






    


