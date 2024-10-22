<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseNewItem;
use App\Models\Supplier;


class OrderManagementController extends Controller{

    public function index(Request $request){
        $data = Purchase::query()
                ->leftJoin('supplier', 'purchase_orders.supplier_id', '=', 'supplier.id')
                ->select('purchase_orders.*', 'supplier.supplier_name');
        $getdata = [
            'company_name' => 'company_name',
            'supplier_name' => 'supplier_name',
            'serial_number' => 'serial_number',
            'create_date' => 'create_date',
        ];
    
        foreach ($getdata as $getdata => $name) 
        {
            if ($request->has($name) && $request->input($name) !== null) 
            {
                if ($getdata === 'create_date') {
                    $dateValue = $request->input($name);
                    $data->whereDate('purchase_orders.create_date', $dateValue); 
                }
                if ($getdata === 'company_name') {
                    $data->where('purchase_orders.company_name', 'like', '%' . $request->input($name) . '%');
                }
                if ($getdata === 'supplier_name') {
                    $data->where('supplier.supplier_name', 'like', '%' . $request->input($name) . '%'); 
                }
                if ($getdata === 'serial_number') {
                    $data->where('purchase_orders.serial_number', 'like', '%' . $request->input($name) . '%');
                }
            }
        }
    
        $orders = $data->where('purchase_orders.is_deleted', 0)->orderBy('purchase_orders.id', 'desc')->paginate(5);
        return view('admin.ordermangement.list', compact('orders'));
    }
    

    public function Add(Request $request, $id = null) {
        $purchase = null;
    
        if ($id) {
            $purchase = Purchase::with('items')->where('id', $id)->where('is_deleted', 0)->first();
        }
        $suppliers = Supplier::where('is_deleted',0)->get(); 
        return view('admin.ordermangement.addorder', compact('purchase','suppliers'));
        
    }
    
    public function view($id){
        $order = Purchase::with('items')->leftJoin('supplier', 'purchase_orders.supplier_id', '=', 'supplier.id')
        ->select('purchase_orders.*', 'supplier.supplier_name')
        ->where('supplier.is_deleted',0)
        ->where('purchase_orders.is_deleted', 0)
        ->where('purchase_orders.id', $id)->first();
        return view('admin.ordermangement.view', compact('order'));
    }
  
    public function save(Request $request) {
        $supplier = $request->input('supplier_id');
       // dd($request->all());
        $validator = Validator::make($request->all(), [
            'company_name'            => 'required|string|max:20',
            'serial_number'           => 'required|string|max:255', 
            'supplier_name'           => 'required|string',
            'delivery_date'           => 'required',
            'create_date'             => 'required|date',
            'item_data.*.style_name'  => 'required|string',
            'item_data.*.item_name'   => 'required|string',
            'item_data.*.hsn_code'    => 'required|string|max:100',
            'item_data.*.color_name'   => 'required|string',
            'item_data.*.size_name'    => 'required|string',
            'item_data.*.quantity'     => 'required|integer|min:1',
            'item_data.*.unit_name'    => 'required|string',
            'item_data.*.rate'         => 'required|numeric|min:0',
        ], 
        [
            'item_data.*.style_name.required' => 'The style name field is required.',
            'item_data.*.item_name.required'  => 'The item name field is required.',
            'item_data.*.hsn_code.required'   => 'The hsn code field is required.',
            'item_data.*.color_name.required' => 'The color name field is required.',
            'item_data.*.size_name.required'  => 'The size name field is required.',
            'item_data.*.quantity.required'   => 'The quantity name field is required.',
            'item_data.*.unit_name.required'  => 'The unit name field is required.',
            'item_data.*.rate.required'       => 'The rate field is required.',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }
        
        if (isset($request->id)) {
            $purchase = Purchase::findOrFail($request->id);
        } else {
            $purchase = new Purchase();
        }
    
        $purchase->company_name  = isset($request->company_name) ? $request->company_name : '';
        $purchase->supplier_id   = isset($request->supplier_name) ? $request->supplier_name : '';
        $purchase->delivery_date = isset($request->delivery_date) ? $request->delivery_date : '';
        $purchase->create_date   = isset($request->create_date) ? $request->create_date : ''; 
        $purchase->serial_number = isset($request->serial_number) ? $request->serial_number : '';
        $purchase->remarks       = isset($request->remarks) ? $request->remarks : ''; 
    
        $purchase->save();
    
        if (!isset($request->id)) {
            $orderId = $purchase->id;
            $orderNumber = $this->generateOrderNumber($orderId);
            Purchase::where('id', $orderId)->update(['order_number' => $orderNumber]);
        }
        
        if(!empty($request->item_data)){
            foreach ($request->item_data as $item) {
                        
                if (isset($item['item_tbl_id'])) {
                    $purchaseItem             =  PurchaseNewItem::findOrFail($item['item_tbl_id']);
                    $purchaseItem->style_name = isset($item['style_name']) ? $item['style_name'] : '' ;
                    $purchaseItem->item_name  = isset($item['item_name']) ? $item['item_name'] : '' ;
                    $purchaseItem->hsn_code   = isset($item['hsn_code']) ? $item['hsn_code'] : '';
                    $purchaseItem->color_name = isset($item['color_name']) ? $item['color_name'] : '';
                    $purchaseItem->size_name  = isset($item['size_name']) ? $item['size_name']: '';
                    $purchaseItem->quantity   = isset($item['quantity']) ? $item['quantity'] : '';
                    $purchaseItem->unit_name  = isset($item['unit_name']) ? $item['unit_name'] : '';
                    $purchaseItem->rate       = isset($item['rate']) ? $item['rate'] : '' ;
                    $purchaseItem->save();
                } else {
                    $purchaseItem             = new PurchaseNewItem();
                    $purchaseItem->order_id   = $purchase->id; 
                    $purchaseItem->style_name = isset($item['style_name']) ? $item['style_name'] : '' ;
                    $purchaseItem->item_name  = isset($item['item_name']) ? $item['item_name'] : '';
                    $purchaseItem->hsn_code   = isset($item['hsn_code']) ? $item['hsn_code'] : '';
                    $purchaseItem->color_name = isset($item['color_name']) ? $item['color_name'] : '' ;
                    $purchaseItem->size_name  = isset($item['size_name']) ? $item['size_name']: '';
                    $purchaseItem->quantity   = isset($item['quantity']) ? $item['quantity'] : '' ;
                    $purchaseItem->unit_name  = isset($item['unit_name']) ? $item['unit_name'] : '';
                    $purchaseItem->rate       = isset($item['rate']) ? $item['rate'] : '';
                    $purchaseItem->save();
                }
            }
        }
    
        $message = isset($request->id) ? 'order updated successfully!' : 'order added successfully!';
        return response()->json(['success' => true, 'message' => $message]);  
    }
    
    public function removeItem($id) {
        $item = PurchaseNewItem::find($id);
        if ($item) {
            PurchaseNewItem::where('id', $id)->update(['is_deleted' => 1]);
        }else{
            return redirect()->back()->with('error','can not remove this row');
        }
        return redirect()->back();
    }
   
        
    private function generateOrderNumber($id) {    
        return $id . 'PO2024';
    }
    
    public function addMore(Request $request) {
        $counter = $request->input('counter');
        return view('admin.ordermangement.addMoreItem', compact('counter'));
    }
   
    public function delete($id){
        $order = Purchase::findOrFail($id);
        // dd($order);
        if(!empty($order)){
            Purchase::where('id', $id)->update(['is_deleted' => 1]);
            PurchaseNewItem::where('order_id', $id)->update(['is_deleted' => 1]);  
        }else{
            return response()->json(['error' => 'Order not found.'], 404);
        }
        return response()->json(['success' => 'Order deleted successfully.']);
    }
}
