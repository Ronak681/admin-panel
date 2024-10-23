<?php

namespace App\Http\Controllers\frontendController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;
use App\Models\Heading;
use App\Models\Category;
use App\Models\Post;
use App\Models\Comments;
use App\Models\Subscribe;
use App\Models\About;






class HomeController extends Controller
{
    //
    public function home(){
        $header = Heading::all();
        $banners = Category::where('is_deleted', 0)->with(['icons' => function($query) {
            $query->where('is_deleted', 0);
        }])->limit(3)->get();
        $posts = Post::orderBy('date', 'desc')->take(3)->get(); 
      return view('frontend.home', compact('header','banners','posts'));
    }
    public function shop(){
        return view('frontend.shop');
    }
    public function Blog(){
        $posts = Post::orderBy('date', 'desc')->get(); 

        return view('frontend.Blog',compact('posts'));
    }
    public function Contact(){
        return view('frontend.Contact');
    }
    public function About(){
        $about = About::where('is_deleted', 0)->get();
        return view('frontend.About',compact('about'));
    }
    public function ShoppingCart(){
        return view('frontend.Shopping-cart');
    }
    public function Blogdetails($id){
        $post = Post::with('comments')->findOrFail($id); 
        return view('frontend.blogdetails',compact('post'));
    }
    public function shoppingdetails(){
        return view('frontend.Shoppingdetails');
    }
    public function checkout(){
        return view('frontend.checkout');
    }
   public function comment(Post $post,Request $request){
   // dd($request->all());
    $rules = [
        'name' =>'required',
        'email' =>'required|email',
        'phone_no' =>'required',
        'comment' =>'required',
        
    ];
    $validator = Validator::make($request->all(),$rules);
    if($validator->fails()){
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $comments = new Comments();
    $comments->name = $request->name;
    $comments->email = $request->email;
    $comments->phone_no = $request->phone_no;
    $comments->comment = $request->comment;
    $comments->post_id = $post->id; 

    $comments->save();
    return redirect()->route('Blog.details',$post->id)->with('success','comment added successfully');
   }
   public function subscribe(Request $request) {
    $rules = [
        'email' => 'required|email',
    ];
    $validator = Validator::make($request->all(), $rules);
    
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    $subscribe = new Subscribe();
    $subscribe->email = $request->email;
    $subscribe->save();

    return response()->json(['success' => 'Subscribed successfully!']);
}


  
}
