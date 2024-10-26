<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\AccountDashboardController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\RegisterController;
use App\Http\Controllers\admin\ForgetPasswordController;
use App\Http\Controllers\admin\ChangePasswordController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\admin\OrderManagementController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\HeaderController;
use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\ContactController;



use App\Http\Controllers\frontendController\HomeController;





// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/test',[SupplierController::class,'test'])->name('test');

//user authenticate
/*Route::get('/account', function () {
    dd('ng');
});

Route::get('/admin', function () {
    dd('d'); 
});*/

Route::group(['prefix'=> 'account'],function(){ 
       
    Route::group(['middleware'=>'web.guest'],function(){
    Route::get('/login',[LoginController::class,'index'])->name('account.login');
    Route::post('/login',[LoginController::class,'authenticate'])->name('account.authenticate');
    Route::get('/register',[LoginController::class,'register'])->name('account.register');
    Route::post('/processRegister',[LoginController::class,'processRegister'])->name('account.proessRegister');
});
    Route::group(['middleware'=>'web.auth'],function(){
    Route::get('/logout',[AccountDashboardController::class,'logout'])->name('account.logout');
    Route::get('/dashboard',[AccountDashboardController::class,'index'])->name('account.admin');
});
    

});

/*Route::get('/account/login',[LoginController::class,'index'])->name('account.login');
Route::post('/account/authenticate',[LoginController::class,'authenticate'])->name('account.authenticate');
Route::get('/account/register',[LoginController::class,'register'])->name('account.register');
Route::post('/account/processRegister',[LoginController::class,'processRegister'])->name('account.proessRegister');
Route::get('/account/logout',[LoginController::class,'logout'])->name('account.logout');
Route::get('/account/admin',[LoginController::class,'admin'])->name('account.admin');*/

//admin authenticate
 Route::group(['prefix'=> 'admin'],function(){
    
    //    Route::group(['middleware'=>'admin.guest'],function(){
           
        
    // });
    Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
    Route::get('/register',[RegisterController::class,'register'])->name('admin.register');
    Route::post('/dashboard',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');      
    Route::post('/process-Register',[RegisterController::class,'processRegister'])->name('admin.processRegister');
   
    Route::get('/reset',[ForgetPasswordController::class,'forgot'])->name('admin.forgotpassword');   
    Route::post('/reset_password',[ForgetPasswordController::class,'reset_password'])->name('admin.reset');    
    Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('/verify-token', [RegisterController::class, 'verifyTOken'])->name('verify.token');


       
    Route::group(['middleware'=>'admin.auth'],function(){ 
        Route::any('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout');
    });
 });
Route::get('/admin/change-password',[AdminLoginController::class,'change'])->name('admin.change');
Route::post('/admin/change-password', [AdminLoginController::class, 'updatePassword'])->name('update-password');
Route::get('/admin/change_password',[ChangePasswordController::class,'index'])->name('admin.changePassword');
Route::post('/admin/password-updated',[ChangePasswordController::class,'changePassword'])->name('admin.passwordchanged');


//product route
Route::group(['prefix'=> 'admin'],function(){ 

Route::get('/product/list',[ProductController::class,'index'])->name('admin.product');
Route::get('/create',[ProductController::class,'create'])->name('admin.create');
Route::post('/product',[ProductController::class,'store'])->name('admin.store');
Route::get('/edit/{product}',[ProductController::class,'edit'])->name('admin.edit');
Route::put('/product/{product}',[ProductController::class,'update'])->name('admin.update');
Route::delete('/product/delete/{id}',[ProductController::class,'destroy'])->name('admin.destroy');
Route::delete('/admin/image/delete', [ProductController::class, 'removeImage'])->name('admin.image.delete');


Route::get('/product/category/list',[ProductController::class,'CategoryList'])->name('list.category');
Route::get('/product/category',[ProductController::class,'Addcategory'])->name('add.category');
Route::get('/product/category/{id}',[ProductController::class,'Addcategory'])->name('edit.category');
Route::any('/product/category-save',[ProductController::class,'Savecategory'])->name('save.category');
Route::delete('/product/category/delete/{id}',[ProductController::class,'delete'])->name('delete.category');
Route::post('/remove-icon', [ProductController::class, 'removeIcon'])->name('remove.icon');
Route::post('/remove/image', [ProductController::class, 'removeImage'])->name('remove.image');
});


//






/*Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminLoginController::class, 'admin'])->name('admin.admin');
    // other admin routes
});*/
//blogs
// Route::group(['prefix'=>'admin'],function(){

        Route::get('/blog/create',[BlogController::class,'index'])->name('blog.post');
        Route::post('blog/add',[BlogController::class,'store'])->name('blog.add');
        Route::get('/blog/list',[BlogController::class,'list'])->name('blog.list');
        Route::get('/blog/posts/{id}',[BlogController::class,'delete'])->name('blog.delete');
        Route::get('/blog/edit/{post}',[BlogController::class,'edit'])->name('blog.edit');
        Route::put('/blog/update/{id}',[BlogController::class,'update'])->name('blog.update');
// });


Route::get('/home',[BlogController::class,'home'])->name('blog.home');
Route::get('/blog/show/{id}',[BlogController::class,'show'])->name('blog.show');
//Route::get('/service',[BlogController::class,'service']);
Route::get('/about',[BlogController::class,'about'])->name('blog.about');
Route::get('/blogs',[BlogController::class,'service'])->name('blog.service');


//User Management Routes
Route::get('/admin/add_user/{role_id}',[UserManagementController::class,'index'])->name('add.user');
Route::post('/admin/add-user/{role_id}',[UserManagementController::class,'SaveUser'])->name('save.user');
Route:: get('/admin/user-list/{role_id}',[UserManagementController::class,'showlist'])->name('show.list');
Route::get('/admin/add-user/{role_id}/edit/{user_id}',[UserManagementController::class,'edituser'])->name('edit.user');
Route::put('/admin/user/update/{user_id}', [UserManagementController::class, 'UpdateUser'])->name('update.user');
Route::delete('/admin/user/delete/{user_id}', [UserManagementController::class, 'deleteUser'])->name('delete.user');

//purchase order
Route::get('/admin/purchase-orders', [OrderManagementController::class, 'index'])->name('purchase.list');
Route::get('/admin/add/order',[OrderManagementController::class,'Add'])->name('order.add');
Route::any('/admin/add/order',[OrderManagementController::class,'save'])->name('save.order');
Route::post('/admin/add/ajax/add', [OrderManagementController::class, 'addMore'])->name('ajax.addmore');
Route::get('/admin/orders/{id}', [OrderManagementController::class, 'view'])->name('order.view');
Route::get('/admin/orders/edit/{id}', [OrderManagementController::class, 'Add'])->name('order.edit');
// Route::put('/admin/orders/update/{id}', [OrderManagementController::class, 'saveOrUpdateOrder'])->name('order.update');
Route::delete('/admin/orders/{id}', [OrderManagementController::class, 'delete'])->name('order.delete');
Route::post('order/item/remove/{id}', [OrderManagementController::class, 'removeItem'])->name('order.item.remove');


//supplier
Route::get('/admin/supplier/list',[SupplierController::class,'List'])->name('supplier.list');
Route::get('/admin/suppliers/{id}', [SupplierController::class, 'view'])->name('supplier.view');
Route::get('/admin/supplier/add-supplier',[SupplierController::class,'add'])->name('add.supplier');
Route::any('/admin/suppliers', [SupplierController::class, 'save'])->name('save.supplier');
Route::get('/admin/suppliers/edit/{id}',[SupplierController::class,'add'])->name('edit.supplier');
Route::delete('/admin/suppliers/{id}', [SupplierController::class, 'delete'])->name('delete.supplier');
Route::get('/admin/suppliers/status/{id}', [SupplierController::class, 'status'])->name('status.supplier');
Route::post('/admin/suppliers/delete', [SupplierController::class, 'deleteSelected'])->name('delete.allsupplier');

 //frontend Routes
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/shop',[HomeController::class,'shop'])->name('shop');
Route::get('/blog',[HomeController::class,'Blog'])->name('Blog');
Route::get('/contact',[HomeController::class,'Contact'])->name('Contact');
Route::get('/about',[HomeController::class,'About'])->name('About');
Route::get('/shopping',[HomeController::class,'ShoppingCart'])->name('Shopping-cart');
Route::get('/blog-details/{id}',[HomeController::class,'Blogdetails'])->name('Blog.details');
Route::get('/product-details',[HomeController::class,'shoppingdetails'])->name('shopping-details');
Route::get('/product/checkout',[HomeController::class,'checkout'])->name('checkout');
Route::post('/blog/details/{post}/comment',[HomeController::class,'comment'])->name('save.comment');
Route::post('/blog/subscribe',[HomeController::class,'subscribe'])->name('subscribe.save');
Route::post('/contact/message-sent',[HomeController::class,'SendMessage'])->name('sent.message');
Route::get('/index',[HomeController::class,'index'])->name('frontend.index');

//backend routes
Route::get('/admin/hero/list',[HeaderController::class,'headerList'])->name('headerlist');
Route::get('/admin/hero/add',[HeaderController::class,'add'])->name('add');
Route::post('/admin/hero/save',[HeaderController::class,'save'])->name('save.hero');
Route::get('/admin/hero/edit/{id}',[HeaderController::class,'edit'])->name('edit');
Route::put('/admin/hero/update/{id}',[HeaderController::class,'update'])->name('update');
Route::delete('/admin/hero/delete',[HeaderController::class,'deleteImage'])->name('deleteImage');
Route::delete('/admin/hero/delete/{id}',[HeaderController::class,'delete'])->name('delete.heading');

//about Routes
Route::get('/admin/about/list',[AboutController::class,'index'])->name('about.list');
Route::get('/admin/about/add',[AboutController::class,'add'])->name('about.add');
Route::post('/admin/about/save',[AboutController::class,'save'])->name('about.save');
Route::get('/admin/about/edit/{id}',[AboutController::class,'edit'])->name('about.edit');
Route::put('/admin/about/update/{id}',[AboutController::class,'save'])->name('about.update');
Route::delete('/admin/about/delete/{id}',[AboutController::class,'delete'])->name('about.delete');
//contact routes
Route::get('/admin/contact/list',[ContactController::class,'index'])->name('contact.list');
Route::get('/admin/contact/add',[ContactController::class,'add'])->name('contact.add');
Route::post('/admin/contact/save',[ContactController::class,'save'])->name('contact.save');
Route::get('/admin/contact/edit/{id}',[ContactController::class,'edit'])->name('contact.edit');
Route::put('/admin/contact/update/{id}',[ContactController::class,'update'])->name('contact.update');
Route::delete('/admin/contact/delete/{id}',[ContactController::class,'delete'])->name('contact.delete');











