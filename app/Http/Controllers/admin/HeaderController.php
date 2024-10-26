<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Heading;

class HeaderController extends Controller
{
    //
    public function headerList(){
        $header = Heading::where('is_deleted',0)->get();
        return view('admin.backend.addhero.list',compact('header'));
    }
    public function add(){
        return view('admin.backend.addhero.add');
    }
    public function save(Request $request){
        $rules = [
            'heading' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('add')->withInput()->withErrors($validator);
        }
        $header = new Heading();
        $header->heading           = $request->heading;
        $header->title           = $request->title;
        $header->description           = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/hero'), $imageName); 
            $header->image = $imageName; 
        }

        $header->save();
       return redirect()->route('headerlist')->with('success','headings added successfully');

    }
   
    public function edit($id){
        $header = Heading::findOrFail($id);
        return view('admin.backend.addhero.edit',compact('header'));
    }
    public function update($id,Request $request){
        $header = Heading::findOrFail($id);

        $rules = [
            'heading' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return redirect()->route('edit',$header->id)->withInput()->withErrors($validator);
        }
        
        $header->heading           = $request->heading;
        $header->title           = $request->title;
        $header->description           = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/hero'), $imageName); 
    
            $header->image =  $imageName; 
        }
        $header->save();
        return redirect()->route('headerlist')->with('success', 'Header updated successfully!');


    }
    public function deleteImage(Request $request){

    $request->validate([
        'image' => 'required', 
    ]);

    $imageName = $request->input('image');

    $header = Heading::where('image', $imageName)->first();

    if ($header) {
        $imagePath = 'img/hero/' . $imageName; 
        Storage::delete($imagePath); 

        $header->image = null;
        $header->save(); 

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

    return response()->json(['success' => false, 'message' => 'Image not found.'], 404);
}
public function delete($id){
    $header = Heading::findOrFail($id);
    $header = Heading::where('id',$id)->update(['is_deleted'=> 1]);
    return response()->json(['success' => 'heading deleted successfully.']);

}

}
