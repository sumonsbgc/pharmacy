<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\RegisterController;
use App\Models\Sale;

Route::prefix("admin")->group(function(){

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [LoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register', [RegisterController::class, 'register']);

});

Route::prefix('admin')->group(function(){
    Route::view('dashboard', 'admin.dashboard')->name('admin.dashboard');
    // All User Route
    Route::get('users', [UserController::class, 'index'])->name('admin.users');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::get('user/profile/{id}', [UserController::class, 'profile'])->name('admin.user.profile');
    Route::put('user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');

    // All Brand Route
    Route::get('brands', [BrandController::class, 'index'])->name('admin.brands.index');
    Route::get('brand/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::post('brand/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('brand/edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('brand/update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::delete('brand/delete/{id}', [BrandController::class, 'delete'])->name('admin.brand.delete');

    // All Category Route
    Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('category/delete/{id}', [CategoryController::class, 'delete'])->name('admin.category.delete');

    // All Attribute Routes
    Route::get('attributes', [AttributeController::class, 'index'])->name('admin.attributes.index');
    Route::get('attribute/create', [AttributeController::class, 'create'])->name('admin.attribute.create');
    Route::post('attribute/store', [AttributeController::class, 'store'])->name('admin.attribute.store');
    Route::get('attribute/edit/{id}', [AttributeController::class, 'edit'])->name('admin.attribute.edit');
    Route::put('attribute/update/{id}', [AttributeController::class, 'update'])->name('admin.attribute.update');
    Route::delete('attribute/delete/{id}', [AttributeController::class, 'delete'])->name('admin.attribute.delete');

    // All Attribute Value Routes
    Route::get('attributevalues', [AttributeValueController::class, 'index'])->name('admin.attribute_values.index');
    Route::get('attributevalue/create/{attribute_id}', [AttributeValueController::class, 'create'])->name('admin.attribute_value.create');
    Route::post('attributevalue/store', [AttributeValueController::class, 'store'])->name('admin.attribute_value.store');
    Route::get('attributevalue/edit/{id}', [AttributeValueController::class, 'edit'])->name('admin.attribute_value.edit');
    Route::put('attributevalue/update/{id}', [AttributeValueController::class, 'update'])->name('admin.attribute_value.update');
    Route::delete('attributevalue/delete/{id}', [AttributeValueController::class, 'delete'])->name('admin.attribute_value.delete');

    // All Product Routes
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('get_product/{product_id}', [ProductController::class, 'getProduct'])->name('product.get');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('product/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('product/trash/{id}', [ProductController::class, 'trash'])->name('admin.product.trash');
    Route::get('product/restore/{id}', [ProductController::class, 'restore'])->name('admin.product.restore');
    Route::delete('product/remove/{id}', [ProductController::class, 'trashRemove'])->name('admin.product.remove');
    Route::delete('product/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');

    // All Suppliers Routes
    Route::get('suppliers', [SupplierController::class, 'index'])->name('admin.suppliers.index');
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('admin.supplier.create');
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('admin.supplier.store');
    Route::get('supplier/edit/{id}', [SupplierController::class, 'edit'])->name('admin.supplier.edit');
    Route::put('supplier/update/{id}', [SupplierController::class, 'update'])->name('admin.supplier.update');
    Route::delete('supplier/delete/{id}', [SupplierController::class, 'delete'])->name('admin.supplier.delete');

    // All Purchase Routes
    Route::get('purchases', [PurchaseController::class, 'index'])->name('admin.purchases.index');
    Route::get('purchase/create', [PurchaseController::class, 'create'])->name('admin.purchase.create');
    Route::post('purchase/store', [PurchaseController::class, 'store'])->name('admin.purchase.store');
    Route::get('purchase/edit/{id}', [PurchaseController::class, 'edit'])->name('admin.purchase.edit');
    Route::put('purchase/update/{id}', [PurchaseController::class, 'update'])->name('admin.purchase.update');
    Route::delete('purchase/delete/{id}', [PurchaseController::class, 'delete'])->name('admin.purchase.delete');

    // Sales Routes
    Route::get('sales', [SaleController::class, 'index'])->name('admin.sales.index');
    Route::get('sale/create', [SaleController::class, 'create'])->name('admin.sale.create');
    Route::post('sale/store', [SaleController::class, 'store'])->name('admin.sale.store');
    Route::get('sale/edit/{id}', [SaleController::class, 'edit'])->name('admin.sale.edit');
    Route::put('sale/update/{id}', [SaleController::class, 'update'])->name('admin.sale.update');
    Route::delete('sale/delete/{id}', [SaleController::class, 'delete'])->name('admin.sale.delete');
    
    // Customer Routes
    Route::get('customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('admin.customer.create');
    Route::post('customer/store', [CustomerController::class, 'store'])->name('admin.customer.store');
    Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('admin.customer.edit');
    Route::put('customer/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
    Route::delete('customer/delete/{id}', [CustomerController::class, 'delete'])->name('admin.customer.delete');

    Route::get('invoice', function(){
        $sale = Sale::findOrFail(3);
        return view('admin.invoices.saleInvoice', compact('sale'));
    });

    
});

?>