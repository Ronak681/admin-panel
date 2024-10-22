<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use  App\Models\Supplier;

class SupplierController extends Controller
{
    public function test(){
        return view('test');
    }
    public function List(Request $request) {
        $data = Supplier::query();
        $size = $request->input('size', 5);
    
        $getdata = [
            'supplier_name' => 'supplier_name',
            'email' => 'email',
            'phone_number' => 'phone_number',
        ];
    
        foreach ($getdata as $getdata => $name) {
            if ($request->has($name)) {
                if ($getdata === 'supplier_name') {
                    $data->where('supplier_name', 'like', '%' . $request->input($name) . '%');
                } elseif ($getdata === 'email') {
                    $data->where('email', 'like', '%' . $request->input($name) . '%');
                } elseif ($getdata === 'phone_number') {
                    $data->where('phone_number', 'like', '%' . $request->input($name) . '%');
                }
            }
        }
    
        $suppliers = $data->where('is_deleted', 0)->orderBy('id', 'desc')->paginate($size);
        return view('admin.SupplierManagement.SupplierList', compact('suppliers'));
    }
    

    public function view($id){
        $supplier = Supplier::findOrFail($id);
        if(!empty($supplier)){
          $supplier = Supplier::where('id', $id)->where('is_deleted',0)->first(); 
          return view('admin.SupplierManagement.view', compact('supplier'));
        }
        else{
            return redirect()->route()->with('error','this supplier not found');
        }
    }

    public function add(Request $request,$id=null){
        $supplier = null;
        if($id){
          $supplier = Supplier::where('id',$id)->where('is_deleted',0)->first();
        }
        return view('admin.SupplierManagement.AddSupplier',compact('supplier'));
    }

    public function save(Request $request) {

        if (!$request->input()) {
            return redirect()->back()->with('error','No Data Received , Please Enter Supplier Information');
        }
    
        $rules = [
            'supplier_name' => 'required',
            'email'         => 'required|email|' . (!$request->has('id') ? 'unique:supplier' : 'unique:supplier,email,' . $request->id),
            'phone_number'  => 'required|numeric|min:11',
            'country'       => 'required|string',
            'state'         => 'required|string',
            'city'          => 'required|string',
            'pin_code'      => 'required|min:6',
            'pan_number'    => 'required|string',
            'gst_number'    => 'required',
            'address'       => 'required|string',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        if(isset($request->id)){
            $supplier = Supplier::findOrFail($request->id);
        }else{
            $supplier = new Supplier();
        }
       
        $supplier->supplier_name  =   isset($request->supplier_name) ? $request->supplier_name : '';
        $supplier->email          =   isset($request->email) ? $request->email : '';
        $supplier->phone_number   =   isset($request->phone_number) ? $request->phone_number : '';
        $supplier->country        =   isset($request->country) ? $request->country : '';
        $supplier->state          =   isset($request->state) ? $request->state : '';
        $supplier->city           =   isset($request->city) ? $request->city : '';
        $supplier->pin_code       =   isset($request->pin_code) ? $request->pin_code : '';
        $supplier->gst_number     =   isset($request->gst_number) ? $request->gst_number : '';
        $supplier->pan_number     =   isset($request->pan_number)? $request->pan_number : '';
        $supplier->address        =   isset( $request->address) ? $request->address : '';
        $supplier->save();
        $message = isset($request->id) ? 'Supplier updated successfully!' : 'Supplier added successfully!';
       //dd($request->id);
       return response()->json(['success' => true, 'message' => $message]);
    }

    public function delete($id){
        $supplier = Supplier::findOrFail($id);
        if(!empty($supplier)){
            Supplier::where('id',$id)->update(['is_deleted' => 1]);
            $message = 'supplier deleted successfully';
            return response()->json(['success' => true, 'message' => $message]);
        }else{
            return response()->json(['error' => 'Supplier not found.'], 404);
        }
       
    }
    
    public function status($id){
        $supplier = Supplier::find($id);
        if (!empty($supplier)) {
            Supplier::where('id', $supplier->id)->update(['is_active' =>  $supplier->is_active ? 0 : 1]);
            $message = $supplier->is_active ? 'Supplier status has been deactivated.': 'Supplier status has been activated.';
            return response()->json(['success' => true, 'message' => $message]);
        } else {
            return response()->json(['success' => false, 'message' => 'Supplier not found.']);
        }
    }
    public function deleteSelected(Request $request){
        $ids = $request->input('ids'); 
        if ($ids) {
            $suppliers = Supplier::whereIn('id', $ids)->where('is_deleted', 0)->get();
            //dd($suppliers);
            if ($suppliers->isEmpty()) {
                return response()->json(['error' => 'No suppliers found for deletion.'], 404);
            }
            Supplier::whereIn('id', $ids)->update(['is_deleted' => 1]);
            return response()->json(['success' => 'Selected suppliers deleted successfully.']);
        }
    
        return response()->json(['error' => 'No suppliers selected for deletion.'], 400);
    } 
}
    
    
    
   


    
