<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Profile\AdminController;
use App\Http\Controllers\Profile\MemberController;
use App\Http\Controllers\Root\RootController;
use App\Http\Controllers\Root\RootAuthController;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PageManagerController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\WebManagerController;
use App\Http\Controllers\Admin\RateManagerController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\Admin\MailManagerController;
use App\Http\Controllers\Admin\ConnectManagerController;
use App\Http\Controllers\Admin\BalanceManagerController;
use App\Http\Controllers\Admin\Blog\TagsController;
use App\Http\Controllers\Admin\Blog\CategoryController;
use App\Http\Controllers\Admin\Blog\PostController;
// use App\Http\Controllers\Fotografer\BaseController;


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

Route::get('/dash', function () {
    return view('admin.pages.manage-product-cetak');
});
Route::get('/cetak-test', function () {
    return view('deploy');
});
Route::get('/reply', function () {
    return view('reply');
});
Route::get('/cetak-nota', function () {
    return view('base.pdf.base-pdf-invoice');
});
Route::get('/errors-verify', function () {
    $data['title'] = "iSchool";
    $data['menu'] = "Error";
    $data['submenu'] = "Error Verify";
    $data['subdesc'] = "Halaman error, akun anda belum diverifikasi";
    $data['web'] = App\Models\WebSetting::all()->first();

    return view('base.base-errors',$data);
})->name('errors.verify');

Route::get('/errors-access', function () {
    $data['title'] = "iSchool";
    $data['menu'] = "Error";
    $data['submenu'] = "Error Access";
    $data['subdesc'] = "Halaman error, akun anda tidak diizinkan untuk mengakses halaman ini";
    $data['web'] = App\Models\WebSetting::all()->first();

    return view('base.base-errors', $data);
})->name('errors.access');

Route::get('/', [RootController::class, 'index'])->name('root.root-main-index');
Route::get('/product', [RootController::class, 'product'])->name('root.root-main-product');
Route::get('/product/{slug}', [RootController::class, 'productDetail'])->name('root.root-main-product-detail');
Route::get('/portfolio', [RootController::class, 'portofolio'])->name('root.root-main-portofolio');
Route::get('/portfolio/{slug}', [RootController::class, 'portofolioDetail'])->name('root.root-main-portofolio-detail');
Route::get('/contact-us', [RootController::class, 'contact'])->name('root.root-main-contact');
Route::post('/contact-us/store', [RootController::class, 'contactStore'])->name('root.root-main-contact-store');
Route::get('/blog', [RootController::class, 'blogIndex'])->name('root.root-main-blog-index');
Route::get('/blog/category/{category:category_slug}', [RootController::class, 'blogCategory'])->name('root.root-main-blog-category');
Route::get('/blog/tags/{tag:tags_slug}', [RootController::class, 'blogTags'])->name('root.root-main-blog-tags');
Route::get('/blog/{slug}/details', [RootController::class, 'blogDetails'])->name('root.root-main-blog-details');

Route::group(['middleware' => ['verified']],function(){
    Route::post('/member/signout',[MemberController::class,'logout'])->name('auth-member.auth-signout');

    // CONNECT
    Route::get('/member/connect/{code}/view',[RootAuthController::class,'connectView'])->name('auth-member.connect-view');
    Route::post('/member/connect/replyMember',[RootAuthController::class,'replyMember'])->name('auth-member.connect-replyMember');
    // HALAMAN RIWAYAT CHECKOUT
    Route::get('/member/history',[RootAuthController::class,'historyCheckout'])->name('auth-member.history-checkout');
    Route::get('/member/history/{code}/details',[RootAuthController::class,'historyCheckoutDetails'])->name('auth-member.history-details');
    Route::get('/member/history/cetak/{code}/data-transaksi',[RootAuthController::class,'cetakInformasiPembayaran'])->name('auth-member.cetak.data-transaksi');
    Route::post('/member/history/give-rating',[RootAuthController::class,'giveRateProducts'])->name('auth-member.give-rate-product');

    // CHECKOUT PRODUCT
    Route::get('/product/{slug}/checkout',[RootAuthController::class,'checkoutProduct'])->name('root.root-main-product-checkout');
    Route::post('/product/{slug}/checkout/store',[RootAuthController::class,'checkoutProductStore'])->name('root.root-main-product-checkout.store');
    // Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
});

// AUTHENTIKASI MEMBER
Route::post('/member/login', [MemberController::class, 'loginPost'])->name('auth-member.auth-signin-post');
Route::post('/member/regist', [MemberController::class, 'registPost'])->name('auth-member.auth-signup-post');
Route::get('/member/verify/{token}', [MemberController::class, 'verify'])->name('auth-member.auth-verify');
Route::post('/member/forgot/request', [MemberController::class, 'forgotSend'])->name('auth-member.auth-forgot-request');
Route::get('/member/forgot/{token}', [MemberController::class, 'forgotChange'])->name('auth-member.auth-forgot-change');
Route::post('/member/forgot/save/{token}', [MemberController::class, 'forgotPost'])->name('auth-member.auth-forgot-post');



// AUTHENTIKASI ADMIN
// Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('login');
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('auth.auth-signin');
Route::post('/admin/login', [AdminController::class, 'loginPost'])->name('auth.auth-signin-post');
Route::get('/admin/regist', [AdminController::class, 'registForm'])->name('auth.auth-signup');
Route::post('/admin/regist', [AdminController::class, 'registPost'])->name('auth.auth-signup-post');
Route::get('/admin/verify/{token}', [AdminController::class, 'verify'])->name('auth.auth-verify');


Route::middleware(['user-access:General Admin' ,'auth:admin' ,'admin', 'verified'])->group(function () {

    Route::post('/admin/signout',[AdminController::class,'logout'])->name('admin.auth-signout');
    Route::get('/admin/dashboard',[BaseController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/profile',[BaseController::class,'profile'])->name('admin.profile.index');
    Route::put('/admin/profile',[BaseController::class,'profileUpdate'])->name('admin.profile.update');

    // KELOLA TAGS PADA BLOG
    Route::get('/admin/manage-blog/tags',[TagsController::class,'index'])->name('admin.manage-blog.tags-index');
    Route::post('/admin/manage-blog/tags',[TagsController::class,'store'])->name('admin.manage-blog.tags-store');
    Route::patch('/admin/manage-blog/tags{id}/update',[TagsController::class,'update'])->name('admin.manage-blog.tags-update');
    Route::delete('/admin/manage-blog/tags{id}/destroy',[TagsController::class,'destroy'])->name('admin.manage-blog.tags-destroy');
    // KELOLA KATEGORI PADA BLOG
    Route::get('/admin/manage-blog/category',[CategoryController::class,'index'])->name('admin.manage-blog.category-index');
    Route::post('/admin/manage-blog/category',[CategoryController::class,'store'])->name('admin.manage-blog.category-store');
    Route::patch('/admin/manage-blog/category/{id}/update',[CategoryController::class,'update'])->name('admin.manage-blog.category-update');
    Route::delete('/admin/manage-blog/category/{id}/destroy',[CategoryController::class,'destroy'])->name('admin.manage-blog.category-destroy');
    // KELOLA POSTINGAN PADA BLOG
    Route::get('/admin/manage-blog/posts',[PostController::class,'index'])->name('admin.manage-blog.posts-index');
    Route::get('/admin/manage-blog/posts/create',[PostController::class,'create'])->name('admin.manage-blog.posts-create');
    Route::get('/admin/manage-blog/posts/{id}/edit',[PostController::class,'edit'])->name('admin.manage-blog.posts-edit');
    Route::post('/admin/manage-blog/posts',[PostController::class,'store'])->name('admin.manage-blog.posts-store');
    Route::patch('/admin/manage-blog/posts/{id}/update',[PostController::class,'update'])->name('admin.manage-blog.posts-update');
    Route::delete('/admin/manage-blog/posts/{id}/destroy',[PostController::class,'destroy'])->name('admin.manage-blog.posts-destroy');

    // Kelola Balance
    Route::get('/admin/manage-balance/',[BalanceManagerController::class,'index'])->name('admin.manage-balance.index');
    Route::get('/admin/manage-balance/pending',[BalanceManagerController::class,'pending'])->name('admin.manage-balance.bal-pending');
    Route::get('/admin/manage-balance/realtime',[BalanceManagerController::class,'sekarang'])->name('admin.manage-balance.bal-sekarang');
    Route::post('/admin/manage-balance/',[BalanceManagerController::class,'store'])->name('admin.manage-balance.store');
    Route::patch('/admin/manage-balance/{id}/update',[BalanceManagerController::class,'update'])->name('admin.manage-balance.update');
    Route::delete('/admin/manage-balance/{id}/destroy',[BalanceManagerController::class,'destroy'])->name('admin.manage-balance.destroy');

    // Kelola Member
    Route::get('/admin/manage-member/',[UserManagerController::class,'index'])->name('admin.manage-member.index');
    Route::post('/admin/manage-member/',[UserManagerController::class,'store'])->name('admin.manage-member.store');
    Route::patch('/admin/manage-member/{id}/update',[UserManagerController::class,'update'])->name('admin.manage-member.update');
    Route::delete('/admin/manage-member/{id}/destroy',[UserManagerController::class,'destroy'])->name('admin.manage-member.destroy');
    // Kelola Admin
    Route::get('/admin/manage-admin/',[UserManagerController::class,'AdminIndex'])->name('admin.manage-admin.index');
    Route::post('/admin/manage-admin/',[UserManagerController::class,'AdminStore'])->name('admin.manage-admin.store');
    Route::patch('/admin/manage-admin/{id}/update',[UserManagerController::class,'AdminUpdate'])->name('admin.manage-admin.update');
    Route::delete('/admin/manage-admin/{id}/destroy',[UserManagerController::class,'AdminDestroy'])->name('admin.manage-admin.destroy');
    // Kelola Pesanan
    Route::get('/admin/manage-booking/',[BookingController::class,'index'])->name('admin.manage-booking.index');
    Route::get('/admin/manage-booking/process',[BookingController::class,'onProcess'])->name('admin.manage-booking.book-onprocess');
    Route::get('/admin/manage-booking/finished',[BookingController::class,'finished'])->name('admin.manage-booking.book-finished');
    Route::get('/admin/manage-booking/create',[BookingController::class,'create'])->name('admin.manage-booking.create');
    // Route::get('/admin/manage-booking/getPrice/{id}',[BookingController::class,'getPrice'])->name('admin.manage-booking.getPrice');
    Route::post('/admin/manage-booking/',[BookingController::class,'store'])->name('admin.manage-booking.store');
    Route::patch('/admin/manage-booking/{id}/update',[BookingController::class,'update'])->name('admin.manage-booking.update');
    Route::delete('/admin/manage-booking/{id}/destroy',[BookingController::class,'destroy'])->name('admin.manage-booking.destroy');

    // Kelola Email Manager
    Route::get('/admin/manage-email/',[MailManagerController::class,'index'])->name('admin.manage-email.index');
    Route::get('/admin/manage-email/create',[MailManagerController::class,'create'])->name('admin.manage-email.create');
    Route::get('/admin/manage-email/{code}/view',[MailManagerController::class,'view'])->name('admin.manage-email.view');
    Route::post('/admin/manage-email/',[MailManagerController::class,'store'])->name('admin.manage-email.store');
    Route::post('/admin/manage-email/sendto',[MailManagerController::class,'sendto'])->name('admin.manage-email.sendto');
    Route::patch('/admin/manage-email/{code}/update',[MailManagerController::class,'update'])->name('admin.manage-email.update');
    Route::delete('/admin/manage-email/{code}/delete',[MailManagerController::class,'destroy'])->name('admin.manage-email.destroy');

    // Kelola Rating
    Route::get('/admin/manage-product/rating/',[RateManagerController::class,'index'])->name('admin.manage-product.rating-index');
    Route::get('/admin/manage-product/rating/create',[RateManagerController::class,'create'])->name('admin.manage-product.rating-create');
    Route::get('/admin/manage-product/rating/{id}/edit',[RateManagerController::class,'edit'])->name('admin.manage-product.rating-edit');
    Route::post('/admin/manage-product/rating/',[RateManagerController::class,'store'])->name('admin.manage-product.rating-store');
    Route::patch('/admin/manage-product/rating/{id}/update',[RateManagerController::class,'update'])->name('admin.manage-product.rating-update');
    Route::delete('/admin/manage-product/rating/{id}/delete',[RateManagerController::class,'destroy'])->name('admin.manage-product.rating-destroy');
    // Kelola Product
    Route::get('/admin/manage-product/',[ProductController::class,'index'])->name('admin.manage-product.index');
    Route::get('/admin/manage-product/create',[ProductController::class,'create'])->name('admin.manage-product.create');
    Route::get('/admin/manage-product/{id}/edit',[ProductController::class,'edit'])->name('admin.manage-product.edit');
    Route::post('/admin/manage-product/',[ProductController::class,'store'])->name('admin.manage-product.store');
    Route::patch('/admin/manage-product/{id}/update',[ProductController::class,'update'])->name('admin.manage-product.update');
    Route::delete('/admin/manage-product/{id}/delete',[ProductController::class,'destroy'])->name('admin.manage-product.destroy');

    Route::get('/admin/manage-product/category',[ProductCategoryController::class,'index'])->name('admin.manage-product.category.index');
    Route::post('/admin/manage-product/category',[ProductCategoryController::class,'store'])->name('admin.manage-product.category.store');
    Route::patch('/admin/manage-product/category/{id}/update',[ProductCategoryController::class,'update'])->name('admin.manage-product.category.update');
    Route::delete('/admin/manage-product/category/{id}/delete',[ProductCategoryController::class,'destroy'])->name('admin.manage-product.category.destroy');

    Route::get('/admin/manage-product/gallery',[GalleryController::class,'index'])->name('admin.manage-product.portofolio-index');
    Route::get('/admin/manage-product/gallery/create',[GalleryController::class,'create'])->name('admin.manage-product.portofolio-create');
    Route::post('/admin/manage-product/gallery',[GalleryController::class,'store'])->name('admin.manage-product.portofolio-store');
    Route::get('/admin/manage-product/gallery/{id}/edit',[GalleryController::class,'edit'])->name('admin.manage-product.portofolio-edit');
    Route::patch('/admin/manage-product/gallery/{id}/update',[GalleryController::class,'update'])->name('admin.manage-product.portofolio-update');
    Route::delete('/admin/manage-product/gallery/{id}/delete',[GalleryController::class,'destroy'])->name('admin.manage-product.portofolio-destroy');

    Route::get('/admin/manage-connect',[ConnectManagerController::class,'index'])->name('admin.manage-connect.index');
    Route::get('/admin/manage-connect/{code}/view',[ConnectManagerController::class,'view'])->name('admin.manage-connect.view');
    Route::post('/admin/manage-connect',[ConnectManagerController::class,'store'])->name('admin.manage-connect.store');
    Route::post('/admin/manage-connect/replyAdmin',[ConnectManagerController::class,'replyAdmin'])->name('admin.manage-connect.replyAdmin');
    Route::patch('/admin/manage-connect/{id}/update',[ConnectManagerController::class,'update'])->name('admin.manage-connect.update');
    // Route::delete('/admin/manage-connect/{id}/delete',[ConnectManagerController::class,'destroy'])->name('admin.manage-connect.destroy');

    // Kelola Halaman
    Route::get('/admin/manage-page',[PageManagerController::class,'index'])->name('admin.manage-page.index');
    Route::post('/admin/manage-page',[PageManagerController::class,'store'])->name('admin.manage-page.store');
    Route::patch('/admin/manage-page/{id}/update',[PageManagerController::class,'update'])->name('admin.manage-page.update');
    Route::delete('/admin/manage-page/destroy/{id}',[PageManagerController::class,'destroy'])->name('admin.manage-page.destroy');
    // Kelola Website
    // Route::get('/admin/manage-web',[WebManagerController::class,'index'])->name('admin.manage-web.index');
    // Route::put('/admin/manage-web',[WebManagerController::class,'update'])->name('admin.manage-web.update');

    // SESSION PERCETAKAN
    // Route::get('/admin/manage-booking/{month}/{year}/cetak/',[BookingController::class,'cetakData'])->name('admin.manage-booking.cetak');
    Route::post('/admin/manage-booking/cetak/',[BookingController::class,'cetakData'])->name('admin.manage-booking.cetak');


});
Route::group(['middleware' => ['user-access:General Fotografer' ,'auth:admin' , 'admin', 'verified']],function(){
    Route::post('/fotografer/signout',[AdminController::class,'logout'])->name('fotografer.auth-signout');
    Route::get('/fotografer/dashboard',[App\Http\Controllers\Fotografer\BaseController::class,'index'])->name('fotografer.dashboard');
    Route::get('/fotografer/profile',[App\Http\Controllers\Fotografer\BaseController::class,'profile'])->name('fotografer.profile.index');
    Route::put('/fotografer/profile',[App\Http\Controllers\Fotografer\BaseController::class,'profileUpdate'])->name('fotografer.profile.update');
    Route::get('/fotografer/jobs',[App\Http\Controllers\Fotografer\BaseController::class,'jobsIndex'])->name('fotografer.jobs.index');
    Route::get('/fotografer/jobs/onprocess',[App\Http\Controllers\Fotografer\BaseController::class,'jobsOnProcess'])->name('fotografer.jobs.onprocess');
    Route::get('/fotografer/jobs/completed',[App\Http\Controllers\Fotografer\BaseController::class,'jobsCompleted'])->name('fotografer.jobs.completed');

    Route::get('/fotografer/manage-product/gallery',[App\Http\Controllers\Fotografer\GalleryController::class,'index'])->name('fotografer.manage-product.portofolio-index');
    Route::get('/fotografer/manage-product/gallery/create',[App\Http\Controllers\Fotografer\GalleryController::class,'create'])->name('fotografer.manage-product.portofolio-create');
    Route::post('/fotografer/manage-product/gallery',[App\Http\Controllers\Fotografer\GalleryController::class,'store'])->name('fotografer.manage-product.portofolio-store');
    Route::get('/fotografer/manage-product/gallery/{id}/edit',[App\Http\Controllers\Fotografer\GalleryController::class,'edit'])->name('fotografer.manage-product.portofolio-edit');
    Route::patch('/fotografer/manage-product/gallery/{id}/update',[App\Http\Controllers\Fotografer\GalleryController::class,'update'])->name('fotografer.manage-product.portofolio-update');
    Route::delete('/fotografer/manage-product/gallery/{id}/delete',[App\Http\Controllers\Fotografer\GalleryController::class,'destroy'])->name('fotografer.manage-product.portofolio-destroy');
});

Route::group(['middleware' => ['user-access:General Manager' ,'auth:admin' , 'admin', 'verified']],function(){
    Route::post('/manager/signout',[AdminController::class,'logout'])->name('manager.auth-signout');
    Route::get('/manager/dashboard',[App\Http\Controllers\Manager\BaseController::class,'index'])->name('manager.dashboard');
    Route::get('/manager/profile',[App\Http\Controllers\Manager\BaseController::class,'profile'])->name('manager.profile.index');
    Route::put('/manager/profile',[App\Http\Controllers\Manager\BaseController::class,'profileUpdate'])->name('manager.profile.update');

    // KELOLA TAGS PADA BLOG
    Route::get('/manager/manage-blog/tags',[App\Http\Controllers\Manager\Blog\TagsController::class,'index'])->name('manager.manage-blog.tags-index');
    Route::post('/manager/manage-blog/tags',[App\Http\Controllers\Manager\Blog\TagsController::class,'store'])->name('manager.manage-blog.tags-store');
    Route::patch('/manager/manage-blog/tags{id}/update',[App\Http\Controllers\Manager\Blog\TagsController::class,'update'])->name('manager.manage-blog.tags-update');
    Route::delete('/manager/manage-blog/tags{id}/destroy',[App\Http\Controllers\Manager\Blog\TagsController::class,'destroy'])->name('manager.manage-blog.tags-destroy');
    // KELOLA KATEGORI PADA BLOG
    Route::get('/manager/manage-blog/category',[App\Http\Controllers\Manager\Blog\CategoryController::class,'index'])->name('manager.manage-blog.category-index');
    Route::post('/manager/manage-blog/category',[App\Http\Controllers\Manager\Blog\CategoryController::class,'store'])->name('manager.manage-blog.category-store');
    Route::patch('/manager/manage-blog/category/{id}/update',[App\Http\Controllers\Manager\Blog\CategoryController::class,'update'])->name('manager.manage-blog.category-update');
    Route::delete('/manager/manage-blog/category/{id}/destroy',[App\Http\Controllers\Manager\Blog\CategoryController::class,'destroy'])->name('manager.manage-blog.category-destroy');
    // KELOLA POSTINGAN PADA BLOG
    Route::get('/manager/manage-blog/posts',[App\Http\Controllers\Manager\Blog\PostController::class,'index'])->name('manager.manage-blog.posts-index');
    Route::get('/manager/manage-blog/posts/create',[App\Http\Controllers\Manager\Blog\PostController::class,'create'])->name('manager.manage-blog.posts-create');
    Route::get('/manager/manage-blog/posts/{id}/edit',[App\Http\Controllers\Manager\Blog\PostController::class,'edit'])->name('manager.manage-blog.posts-edit');
    Route::post('/manager/manage-blog/posts',[App\Http\Controllers\Manager\Blog\PostController::class,'store'])->name('manager.manage-blog.posts-store');
    Route::patch('/manager/manage-blog/posts/{id}/update',[App\Http\Controllers\Manager\Blog\PostController::class,'update'])->name('manager.manage-blog.posts-update');
    Route::delete('/manager/manage-blog/posts/{id}/destroy',[App\Http\Controllers\Manager\Blog\PostController::class,'destroy'])->name('manager.manage-blog.posts-destroy');

    // Kelola Balance
    Route::get('/manager/manage-balance/',[App\Http\Controllers\Manager\BalanceManagerController::class,'index'])->name('manager.manage-balance.index');
    Route::get('/manager/manage-balance/pending',[App\Http\Controllers\Manager\BalanceManagerController::class,'pending'])->name('manager.manage-balance.bal-pending');
    Route::get('/manager/manage-balance/realtime',[App\Http\Controllers\Manager\BalanceManagerController::class,'sekarang'])->name('manager.manage-balance.bal-sekarang');
    Route::post('/manager/manage-balance/',[App\Http\Controllers\Manager\BalanceManagerController::class,'store'])->name('manager.manage-balance.store');
    Route::patch('/manager/manage-balance/{id}/update',[App\Http\Controllers\Manager\BalanceManagerController::class,'update'])->name('manager.manage-balance.update');
    Route::delete('/manager/manage-balance/{id}/destroy',[App\Http\Controllers\Manager\BalanceManagerController::class,'destroy'])->name('manager.manage-balance.destroy');
    // Kelola Member
    Route::get('/manager/manage-member/',[App\Http\Controllers\Manager\UserManagerController::class,'index'])->name('manager.manage-member.index');
    Route::post('/manager/manage-member/',[App\Http\Controllers\Manager\UserManagerController::class,'store'])->name('manager.manage-member.store');
    Route::patch('/manager/manage-member/{id}/update',[App\Http\Controllers\Manager\UserManagerController::class,'update'])->name('manager.manage-member.update');
    Route::delete('/manager/manage-member/{id}/destroy',[App\Http\Controllers\Manager\UserManagerController::class,'destroy'])->name('manager.manage-member.destroy');
    // Kelola Admin
    Route::get('/manager/manage-admin/',[App\Http\Controllers\Manager\UserManagerController::class,'AdminIndex'])->name('manager.manage-admin.index');
    Route::post('/manager/manage-admin/',[App\Http\Controllers\Manager\UserManagerController::class,'AdminStore'])->name('manager.manage-admin.store');
    Route::patch('/manager/manage-admin/{id}/update',[App\Http\Controllers\Manager\UserManagerController::class,'AdminUpdate'])->name('manager.manage-admin.update');
    Route::delete('/manager/manage-admin/{id}/destroy',[App\Http\Controllers\Manager\UserManagerController::class,'AdminDestroy'])->name('manager.manage-admin.destroy');
    // Kelola Pesanan
    Route::get('/manager/manage-booking/',[App\Http\Controllers\Manager\BookingController::class,'index'])->name('manager.manage-booking.index');
    Route::get('/manager/manage-booking/process',[App\Http\Controllers\Manager\BookingController::class,'onProcess'])->name('manager.manage-booking.book-onprocess');
    Route::get('/manager/manage-booking/finished',[App\Http\Controllers\Manager\BookingController::class,'finished'])->name('manager.manage-booking.book-finished');
    Route::get('/manager/manage-booking/create',[App\Http\Controllers\Manager\BookingController::class,'create'])->name('manager.manage-booking.create');
    // Route::get('/manager/manage-booking/getPrice/{id}',[App\Http\Controllers\Manager\BookingController::class,'getPrice'])->name('manager.manage-booking.getPrice');
    Route::post('/manager/manage-booking/',[App\Http\Controllers\Manager\BookingController::class,'store'])->name('manager.manage-booking.store');
    Route::patch('/manager/manage-booking/{id}/update',[App\Http\Controllers\Manager\BookingController::class,'update'])->name('manager.manage-booking.update');
    Route::delete('/manager/manage-booking/{id}/destroy',[App\Http\Controllers\Manager\BookingController::class,'destroy'])->name('manager.manage-booking.destroy');
    // Kelola Product
    Route::get('/manager/manage-product/',[App\Http\Controllers\Manager\ProductController::class,'index'])->name('manager.manage-product.index');
    Route::get('/manager/manage-product/create',[App\Http\Controllers\Manager\ProductController::class,'create'])->name('manager.manage-product.create');
    Route::get('/manager/manage-product/{id}/edit',[App\Http\Controllers\Manager\ProductController::class,'edit'])->name('manager.manage-product.edit');
    Route::post('/manager/manage-product/',[App\Http\Controllers\Manager\ProductController::class,'store'])->name('manager.manage-product.store');
    Route::patch('/manager/manage-product/{id}/update',[App\Http\Controllers\Manager\ProductController::class,'update'])->name('manager.manage-product.update');
    Route::delete('/manager/manage-product/{id}/delete',[App\Http\Controllers\Manager\ProductController::class,'destroy'])->name('manager.manage-product.destroy');
    // Kelola Kategori Produk
    Route::get('/manager/manage-product/category',[App\Http\Controllers\Manager\ProductCategoryController::class,'index'])->name('manager.manage-product.category.index');
    Route::post('/manager/manage-product/category',[App\Http\Controllers\Manager\ProductCategoryController::class,'store'])->name('manager.manage-product.category.store');
    Route::patch('/manager/manage-product/category/{id}/update',[App\Http\Controllers\Manager\ProductCategoryController::class,'update'])->name('manager.manage-product.category.update');
    Route::delete('/manager/manage-product/category/{id}/delete',[App\Http\Controllers\Manager\ProductCategoryController::class,'destroy'])->name('manager.manage-product.category.destroy');
    // Kelola Portfolio
    Route::get('/manager/manage-product/gallery',[App\Http\Controllers\Manager\GalleryController::class,'index'])->name('manager.manage-product.portofolio-index');
    Route::get('/manager/manage-product/gallery/create',[App\Http\Controllers\Manager\GalleryController::class,'create'])->name('manager.manage-product.portofolio-create');
    Route::post('/manager/manage-product/gallery',[App\Http\Controllers\Manager\GalleryController::class,'store'])->name('manager.manage-product.portofolio-store');
    Route::get('/manager/manage-product/gallery/{id}/edit',[App\Http\Controllers\Manager\GalleryController::class,'edit'])->name('manager.manage-product.portofolio-edit');
    Route::patch('/manager/manage-product/gallery/{id}/update',[App\Http\Controllers\Manager\GalleryController::class,'update'])->name('manager.manage-product.portofolio-update');
    Route::delete('/manager/manage-product/gallery/{id}/delete',[App\Http\Controllers\Manager\GalleryController::class,'destroy'])->name('manager.manage-product.portofolio-destroy');
    // Kelola Rating
    Route::get('/manager/manage-product/rating/',[App\Http\Controllers\Manager\RateManagerController::class,'index'])->name('manager.manage-product.rating-index');
    Route::get('/manager/manage-product/rating/create',[App\Http\Controllers\Manager\RateManagerController::class,'create'])->name('manager.manage-product.rating-create');
    Route::get('/manager/manage-product/rating/{id}/edit',[App\Http\Controllers\Manager\RateManagerController::class,'edit'])->name('manager.manage-product.rating-edit');
    Route::post('/manager/manage-product/rating/',[App\Http\Controllers\Manager\RateManagerController::class,'store'])->name('manager.manage-product.rating-store');
    Route::patch('/manager/manage-product/rating/{id}/update',[App\Http\Controllers\Manager\RateManagerController::class,'update'])->name('manager.manage-product.rating-update');
    Route::delete('/manager/manage-product/rating/{id}/delete',[App\Http\Controllers\Manager\RateManagerController::class,'destroy'])->name('manager.manage-product.rating-destroy');
    // Kelola Connect
    Route::get('/manager/manage-connect',[App\Http\Controllers\Manager\ConnectManagerController::class,'index'])->name('manager.manage-connect.index');
    Route::get('/manager/manage-connect/{code}/view',[App\Http\Controllers\Manager\ConnectManagerController::class,'view'])->name('manager.manage-connect.view');
    Route::post('/manager/manage-connect',[App\Http\Controllers\Manager\ConnectManagerController::class,'store'])->name('manager.manage-connect.store');
    Route::post('/manager/manage-connect/replyAdmin',[App\Http\Controllers\Manager\ConnectManagerController::class,'replyAdmin'])->name('manager.manage-connect.replyAdmin');
    Route::patch('/manager/manage-connect/{id}/update',[App\Http\Controllers\Manager\ConnectManagerController::class,'update'])->name('manager.manage-connect.update');
    // Route::delete('/manager/manage-connect/{id}/delete',[App\Http\Controllers\Manager\ConnectManagerController::class,'destroy'])->name('manager.manage-connect.destroy');
    // Kelola Halaman
    Route::get('/manager/manage-page',[App\Http\Controllers\Manager\PageManagerController::class,'index'])->name('manager.manage-page.index');
    Route::post('/manager/manage-page',[App\Http\Controllers\Manager\PageManagerController::class,'store'])->name('manager.manage-page.store');
    Route::patch('/manager/manage-page/{id}/update',[App\Http\Controllers\Manager\PageManagerController::class,'update'])->name('manager.manage-page.update');
    Route::delete('/manager/manage-page/destroy/{id}',[App\Http\Controllers\Manager\PageManagerController::class,'destroy'])->name('manager.manage-page.destroy');
    // Kelola Website
    Route::get('/manager/manage-web',[App\Http\Controllers\Manager\WebManagerController::class,'index'])->name('manager.manage-web.index');
    Route::put('/manager/manage-web',[App\Http\Controllers\Manager\WebManagerController::class,'update'])->name('manager.manage-web.update');
    // Kelola Email Manager
    Route::get('/manager/manage-email/',[App\Http\Controllers\Manager\MailManagerController::class,'index'])->name('manager.manage-email.index');
    Route::get('/manager/manage-email/create',[App\Http\Controllers\Manager\MailManagerController::class,'create'])->name('manager.manage-email.create');
    Route::get('/manager/manage-email/{code}/view',[App\Http\Controllers\Manager\MailManagerController::class,'view'])->name('manager.manage-email.view');
    Route::post('/manager/manage-email/',[App\Http\Controllers\Manager\MailManagerController::class,'store'])->name('manager.manage-email.store');
    Route::post('/manager/manage-email/sendto',[App\Http\Controllers\Manager\MailManagerController::class,'sendto'])->name('manager.manage-email.sendto');
    Route::patch('/manager/manage-email/{code}/update',[App\Http\Controllers\Manager\MailManagerController::class,'update'])->name('manager.manage-email.update');
    Route::delete('/manager/manage-email/{code}/delete',[App\Http\Controllers\Manager\MailManagerController::class,'destroy'])->name('manager.manage-email.destroy');
    // SESSION PERCETAKAN
    // Route::get('/manager/manage-booking/{month}/{year}/cetak/',[App\Http\Controllers\Manager\BookingController::class,'cetakData'])->name('manager.manage-booking.cetak');
    Route::post('/manager/manage-booking/cetak/',[App\Http\Controllers\Manager\BookingController::class,'cetakData'])->name('manager.manage-booking.cetak');
});
