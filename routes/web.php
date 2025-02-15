<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AssociationLinkController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ClientTestimonialController;
use App\Http\Controllers\Admin\CustomerCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\JobNoticeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSubCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Models\JobNotice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->prefix('admin')->as('admin.')->group(function () {


Route::get('/home', [HomeController::class, 'index'])->name('home');



    // Route to view the About page
    Route::get('/about', [AboutController::class, 'index'])->name('all_about');

    // Route to show the edit form
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('edit_about');

    // Route to handle the update
    Route::post('/about/edit', [AboutController::class, 'editPost'])->name('update_about');

    Route::get('/association-links', [AssociationLinkController::class, 'index'])->name('association_web_url');

    // Show the add association link form
    Route::get('/association-links/add', [AssociationLinkController::class, 'add'])->name('association_web_url_add');

    // Handle the form submission to add a new link
    Route::post('/association-links/add', [AssociationLinkController::class, 'addPost'])->name('association_web_url_add_post');

    // Show the edit form for a specific association link
    Route::get('/association-links/edit/{link}', [AssociationLinkController::class, 'edit'])->name('association_web_url_edit');

    // Handle the form submission to update an association link
    Route::post('/association-links/edit/{link}', [AssociationLinkController::class, 'editPost'])->name('association_web_url_edit_post');

    // Delete an association link
    Route::delete('/association-links/delete/{link}', [AssociationLinkController::class, 'delete'])->name('association_web_url_delete');



    Route::resource('certificate', CertificateController::class)->except(['show']);
    // or define custom routes if you prefer
    Route::get('certificate/all', [CertificateController::class, 'index'])->name('all_certificate');
    Route::get('certificate/add', [CertificateController::class, 'add'])->name('add_certificate');
    Route::post('certificate/add', [CertificateController::class, 'addPost'])->name('add_certificate_post');
    Route::get('certificate/edit/{certificate}', [CertificateController::class, 'edit'])->name('edit_certificate');
    Route::post('certificate/edit/{certificate}', [CertificateController::class, 'editPost'])->name('edit_certificate_post');
    Route::post('certificate/delete', [CertificateController::class, 'delete'])->name('delete_certificate');


    Route::get('clients', [ClientController::class, 'allClient'])->name('all.client');
    Route::get('clients/add', [ClientController::class, 'addClientForm'])->name('add.client.form');
    Route::post('clients/add', [ClientController::class, 'addClient'])->name('add.client');
    Route::get('clients/edit/{client}', [ClientController::class, 'editClient'])->name('edit.client');
    Route::post('clients/edit/{client}', [ClientController::class, 'updateClient'])->name('update.client');
    Route::post('clients/delete', [ClientController::class, 'deleteClient'])->name('delete.client');


    Route::get('client-testimonials', [ClientTestimonialController::class, 'index'])->name('admin_all_client_testimonial');
    Route::get('client-testimonials/add', [ClientTestimonialController::class, 'add'])->name('admin_add_client_testimonial');
    Route::post('client-testimonials/add', [ClientTestimonialController::class, 'addPost'])->name('admin_add_client_testimonial_post');
    Route::get('client-testimonials/edit/{say}', [ClientTestimonialController::class, 'edit'])->name('admin_edit_client_testimonial');
    Route::post('client-testimonials/edit/{say}', [ClientTestimonialController::class, 'editPost'])->name('admin_edit_client_testimonial_post');
    Route::post('client-testimonials/delete', [ClientTestimonialController::class, 'delete'])->name('admin_delete_client_testimonial');

    Route::get('customer-categories', [CustomerCategoryController::class, 'index'])->name('customer.category');
    Route::get('customer-categories/add', [CustomerCategoryController::class, 'add'])->name('customer.category.add');
    Route::post('customer-categories/add', [CustomerCategoryController::class, 'addPost'])->name('customer.category.addPost');
    Route::get('customer-categories/edit/{category}', [CustomerCategoryController::class, 'edit'])->name('customer.category.edit');
    Route::post('customer-categories/edit/{category}', [CustomerCategoryController::class, 'editPost'])->name('customer.category.editPost');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');



    Route::get('equipments', [EquipmentController::class, 'index'])->name('admin_all_equipment');
    Route::get('equipments/add', [EquipmentController::class, 'add'])->name('admin_add_equipment');
    Route::post('equipments/add', [EquipmentController::class, 'addPost'])->name('admin_add_equipment_post');
    Route::get('equipments/edit/{equipment}', [EquipmentController::class, 'edit'])->name('admin_edit_equipment');
    Route::post('equipments/edit/{equipment}', [EquipmentController::class, 'editPost'])->name('admin_edit_equipment_post');
    Route::post('equipments/delete', [EquipmentController::class, 'delete'])->name('admin_delete_equipment');

    Route::get('gallery', [GalleryController::class, 'index'])->name('admin_all_gallery_item');
    Route::get('gallery/add', [GalleryController::class, 'add'])->name('admin_add_gallery_item');
    Route::post('gallery/add', [GalleryController::class, 'addPost'])->name('admin_add_gallery_item');
    Route::get('gallery/edit/{item}', [GalleryController::class, 'edit'])->name('admin_edit_gallery_item');
    Route::post('gallery/edit/{item}', [GalleryController::class, 'editPost'])->name('admin_edit_gallery_item_post');
    Route::post('gallery/delete', [GalleryController::class, 'delete'])->name('admin_delete_gallery_item');
    Route::post('gallery/upload-image', [GalleryController::class, 'uploadImage'])->name('gallery_upload_image');


    Route::get('gallery-images', [GalleryImageController::class, 'index'])->name('gallery-images.index');
    Route::get('gallery-image/add', [GalleryImageController::class, 'add'])->name('gallery-image.add');
    Route::post('gallery-image/add', [GalleryImageController::class, 'addPost'])->name('gallery.add');
    Route::get('gallery-image/edit/{gallery}', [GalleryImageController::class, 'edit'])->name('gallery-image.edit');
    Route::post('gallery-image/edit/{gallery}', [GalleryImageController::class, 'editPost'])->name('gallery-image.editPost');
    Route::post('gallery-image/upload', [GalleryImageController::class, 'uploadImage'])->name('gallery-image.uploadImage');



    Route::get('job-notices', [JobNoticeController::class, 'index'])->name('job.notice');
    Route::get('job-notice/add', [JobNoticeController::class, 'add'])->name('job.notice.add');
    Route::post('job-notice/add', [JobNoticeController::class, 'addPost'])->name('job.notice.addPost');
    Route::get('job-notice/edit/{jobNotice}', [JobNoticeController::class, 'edit'])->name('job.notice.edit');
    Route::post('job-notice/edit/{jobNotice}', [JobNoticeController::class, 'editPost'])->name('job.notice.editPost');
    Route::delete('job-notice/delete', [JobNoticeController::class, 'delete'])->name('job.notice.delete');
    Route::get('job-applies', [JobNoticeController::class, 'jobApplyList'])->name('job.apply.list');
    Route::post('job-apply/delete', [JobNoticeController::class, 'jobApplyDelete'])->name('job.apply.delete');
    Route::get('job-apply/details/{id}', [JobNoticeController::class, 'jobApplyDetails'])->name('job.apply.details');



    Route::get('news-events', [NewsController::class, 'index'])->name('news.index');
    Route::get('news-event/add', [NewsController::class, 'add'])->name('news.add');
    Route::post('news-event/add', [NewsController::class, 'addPost'])->name('news.addPost');
    Route::get('news-event/edit/{news}', [NewsController::class, 'edit'])->name('news.edit');
    Route::post('news-event/edit/{news}', [NewsController::class, 'editPost'])->name('news.editPost');
    Route::post('news-event/delete', [NewsController::class, 'delete'])->name('news.delete');


    Route::get('brand', [BrandController::class, 'index'])->name('brand');
    Route::get('brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::post('brand/add', [BrandController::class, 'addPost'])->name('brand.addPost');
    Route::get('brand/edit/{brand}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::post('brand/edit/{product}', [BrandController::class, 'editPost'])->name('brand.editPost');
    Route::delete('brand/delete', [BrandController::class, 'delete'])->name('brand.delete');



    Route::get('product-categories', [ProductCategoryController::class, 'index'])->name('product.category');
    Route::get('product-category/add', [ProductCategoryController::class, 'add'])->name('product.category.add');
    Route::post('product-category/add', [ProductCategoryController::class, 'addPost'])->name('product.category.addPost');
    Route::get('product-category/edit/{category}', [ProductCategoryController::class, 'edit'])->name('product.category.edit');
    Route::post('product-category/edit/{category}', [ProductCategoryController::class, 'editPost'])->name('product.category.editPost');
    Route::delete('product-category/delete', [ProductCategoryController::class, 'delete'])->name('product.category.delete');


    Route::get('products', [ProductController::class, 'index'])->name('products');
    Route::get('product/add', [ProductController::class, 'add'])->name('product.add');
    Route::post('product/add', [ProductController::class, 'addPost'])->name('product.addPost');
    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/edit/{product}', [ProductController::class, 'editPost'])->name('product.editPost');
    Route::delete('product/delete', [ProductController::class, 'delete'])->name('product.delete');



    Route::get('product-sub-categories', [ProductSubCategoryController::class, 'index'])->name('product_sub_category');
    Route::get('product-sub-category/add', [ProductSubCategoryController::class, 'add'])->name('product_sub_category.add');
    Route::post('product-sub-category/add', [ProductSubCategoryController::class, 'addPost'])->name('product_sub_category.addPost');
    Route::get('product-sub-category/edit/{subCategory}', [ProductSubCategoryController::class, 'edit'])->name('product_sub_category.edit');
    Route::post('product-sub-category/edit/{subCategory}', [ProductSubCategoryController::class, 'editPost'])->name('product_sub_category.editPost');
    Route::post('product-sub-category/get', [ProductSubCategoryController::class, 'getSubCategory'])->name('product_sub_category.getSubCategory');


    Route::get('projects', [ProjectController::class, 'index'])->name('admin_all_project');
    Route::get('project/add', [ProjectController::class, 'add'])->name('project.add');
    Route::post('project/add', [ProjectController::class, 'addPost'])->name('project.addPost');
    Route::get('project/edit/{project}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('project/edit/{project}', [ProjectController::class, 'editPost'])->name('project.editPost');
    Route::post('project/delete', [ProjectController::class, 'delete'])->name('project.delete');



    Route::get('services', [ServiceController::class, 'index'])->name('admin_all_service');
    Route::get('service/add', [ServiceController::class, 'add'])->name('service.add');
    Route::post('service/add', [ServiceController::class, 'addPost'])->name('service.addPost');
    Route::get('service/edit/{service}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('service/edit/{service}', [ServiceController::class, 'editPost'])->name('service.editPost');
    Route::post('service/delete', [ServiceController::class, 'delete'])->name('service.delete');


    Route::get('sliders', [SliderController::class, 'index'])->name('admin_all_slider');
    Route::get('slider/add', [SliderController::class, 'add'])->name('slider.add');
    Route::post('slider/add', [SliderController::class, 'addPost'])->name('slider.addPost');
    Route::get('slider/edit/{slider}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::post('slider/edit/{slider}', [SliderController::class, 'editPost'])->name('slider.editPost');
    Route::delete('slider/delete', [SliderController::class, 'delete'])->name('slider.delete');




    Route::get('teams', [TeamController::class, 'index'])->name('admin_all_team');
    Route::get('team/add', [TeamController::class, 'add'])->name('team.add');
    Route::post('team/add', [TeamController::class, 'addPost'])->name('team.addPost');
    Route::get('team/edit/{team}', [TeamController::class, 'edit'])->name('team.edit');
    Route::post('team/edit/{team}', [TeamController::class, 'editPost'])->name('team.editPost');
    Route::post('team/delete', [TeamController::class, 'delete'])->name('team.delete');



});
