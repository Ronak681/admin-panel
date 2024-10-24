<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;


class ContactController extends Controller
{
    //
    public function index(){
        $contact = Contact::where('is_deleted',0)->get();
        return view('admin.backend.contact.list',compact('contact'));
    }
    public function add(){
        return view('admin.backend.contact.add');
    }
    public function save(Request $request){
      //  dd($request->all());
        $rules = [
            'country' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $contact = new Contact();
        $contact->country = $request->country;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->save();
        return redirect()->route('contact.list')->with('success','contact added successfully!');
 
    }
    public function edit($id){
        $contact = Contact::findOrFail($id);
        return view('admin.backend.contact.edit',compact('contact'));
    }
    public function update($id,Request $request){
        $contact = Contact::findOrFail($id);
        $rules = [
            'country' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $contact->country = $request->country;
        $contact->phone = $request->phone;
        $contact->address = $request->address;
        $contact->save();
        return redirect()->route('contact.list')->with('success','contact updated successfully!');
    }
    public function delete($id){
        $contact = Contact::findOrFail($id);
        $contact = Contact::where('id',$id)->update(['is_deleted'=> 1]);
        return response()->json(['success' => 'contact deleted successfully.']);
    }
}
