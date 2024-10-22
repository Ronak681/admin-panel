<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Icon;
use App\Models\Image;

class ProductController extends Controller{

    public function index(){
        $products = Product::with('categories')->where('is_deleted',0)->get();
        //dd($products);
        return view('admin.Product.list',  compact('products')); 
    }
    public function create(){
        $categories = Category::where('is_deleted',0)->get();
        return view('admin.Product.create', compact('categories'));
    }

    public function store(Request $request) {
       
        $rules = [
            'name' => 'required',
            'product' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'discount_price' => 'required|numeric',
            'category_id' => 'required|array', 
            
        ];
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('admin.create')->withInput()->withErrors($validator);
        }
    
        $product = new Product();
        $product->name           = $request->name;
        $product->product        = $request->product;
        $product->price          = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description    = $request->description;
    
        $product->save(); 
    
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = time() . '_' . uniqid() . '.' . $ext;
                $image->move(public_path('uploads/products'), $imageName);
                    $product->images()->create(['image' => $imageName]);
            }
        }
        $product->categories()->attach($request->category_id);
        return redirect()->route('admin.product')->with('success', 'Product added successfully');
    }
    
    public function edit($id){
        $product = Product::findOrFail($id);
        $categories = Category::where('is_deleted',0)->get();
        //dd($categories);
        $productCategory = $product->categories()->first();
        
        $images = $product->images()->where('is_deleted', 0)->get();
        return view('admin.Product.edit',compact('product', 'categories','productCategory','images'));
    }

    public function update($id, Request $request) {
        $product = Product::findOrFail($id);
      
        $rules = [
            'name'           => 'required',
            'product'        => 'required',
            'price'          => 'required|numeric',
            'discount_price' => 'required|numeric',
            'description'    => 'required',
            'category_id'    => 'required|array',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) { 
            return redirect()->route('admin.edit', $product->id)->withInput()->withErrors($validator);
        }
        $product->name           =   isset($request->name) ? $request->name : '';
        $product->product        =   isset($request->product) ? $request->product : '';
        $product->price          =   isset($request->price) ? $request->price : '';
        $product->discount_price =   isset($request->discount_price) ? $request->discount_price : '';
        $product->description    =   isset($request->description) ? $request->description : '';

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                
                $product->images()->create(['image' => $imageName]);
            }
        }
    
        $product->categories()->sync($request->category_id);
        //dd($request->category_id);
        $product->save(); 
        
        return redirect()->route('admin.product')->with('success', 'Product updated successfully');
    }
    public function removeImage(Request $request) {
        if (!$request->input('image')) {
            return response()->json(['success' => false, 'error' => 'No Data found'], 400);
        }
        $imageName = $request->input('image');
        $updated = Image::where('image', $imageName)->update(['is_deleted' => 1]);
        if ($updated) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'error' => 'Failed to update image status'], 500);
        }
    }

    public function destroy($id){

        $product = Product::findOrFail($id);
       // dd($product);
        if($product){
            Product::where('id',$id)->update(['is_deleted' => 1]);
             //dd($product);
            $message = 'Product deleted successfully';
            return response()->json(['success' => true, 'message' => $message]);
        }else{
            return response()->json(['error' => 'product not found.'], 404);
        }   
    }
    public function CategoryList(){
        $categories = Category::where('is_deleted',0)->get();
        return view('admin.Product.CategoryList', compact('categories'));
    }

    public function Addcategory(Request $request,$id=null){
        $category = null; 
        if ($id) {
            $category = Category::where('id', $id)->where('is_deleted', 0)->first();
            if (!$category) {
                return redirect()->route('list.category')->with('error', 'Category not found');
            }
        } 
        $icons = $category ? $category->icons()->where('is_deleted', 0)->get() : [];

        return view('admin.Product.Category',compact('category','icons'));
    }

    public function Savecategory(Request $request, $id = null) {
       // dd($request->all());
        $id = $request->input('id'); 
        $rules = [
            'title' => 'required',
        ];
    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $route = $id ? 'edit.category' : 'add.category';
            return redirect()->route($route, $id)->withInput()->withErrors($validator);
        }
    
        if ($id) {
            $category = Category::findOrFail($id);
        } else {
            $category = new Category();
        }
    
        $category->title = $request->title;
        $category->save();
    
        if ($request->hasFile('icon')) {
            foreach ($request->file('icon') as $icon) {
                $ext = $icon->getClientOriginalExtension();
                $iconName = time() . '_' . uniqid() . '.' . $ext;
                $icon->move(public_path('uploads/banner'), $iconName);
                $category->icons()->create(['icon' => $iconName]);
            }
        }
    
        return redirect()->route('list.category')->with('success', $id ? 'Category updated successfully!' : 'Category added successfully!');
    }
    
    public function removeIcon(Request $request){
        if (!$request->input('icon')) {
            return redirect()->back()->with('error','No Data found');
        }
        $iconName = $request->input('icon');
        Icon::where('icon', $iconName)->update(['is_deleted' => 1]);
        return response()->json(['success' => true]);
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        if(!empty($category)){
            Category::where('id',$id)->update(['is_deleted' => 1]);
            $message = 'category deleted successfully';
            return response()->json(['success' => true, 'message' => $message]);
        }else{
            return response()->json(['error' => 'category not found.'], 404);
        } 
    }
    

}


