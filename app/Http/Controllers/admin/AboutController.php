<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\About;


class AboutController extends Controller
{
    //
    public function index(){
    $about = About::where('is_deleted',0)->get();
        return view('admin.backend.About.list',compact('about'));
    }
    public function add(){
        return view('admin.backend.About.add');
    }
    public function edit($id){
        $about=About::findOrFail($id);
        return view('admin.backend.About.add',compact('about'));
    }
    public function save(Request $request, $id = null) {
        $rules = [
            'heading' => 'required',
            'description' => 'required',
            // 'image' => 'nullable|image', 
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $about = $id ? About::findOrFail($id) : new About();
    
        $about->heading = $request->heading;
        $about->description = $request->description;
    
        if ($request->hasFile('image')) {
           
    
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/about'), $imageName);
            $about->image = $imageName;
        }
    
        $about->save();
    
        $message = $id ? 'About Us information updated successfully.' : 'About Us information saved successfully.';
        return redirect()->route('about.list')->with('success', $message);
    }
    public function delete($id){
        $about = About::findOrFail($id);
        $about = About::where('id',$id)->update(['is_deleted'=> 1]);
        $message = 'deleted successfully';
         return response()->json(['success' => true, 'message' => $message]);
    }
    
}
