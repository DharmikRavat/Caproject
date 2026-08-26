<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/services/{slug}', [PageController::class, 'service'])->name('service.show');
Route::get('/industries', [PageController::class, 'industries'])->name('industries');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/blogs/{slug}', [PageController::class, 'blog'])->name('blog.show');
Route::get('/careers', [PageController::class, 'careers'])->name('careers');
Route::get('/careers/{slug}', [PageController::class, 'career'])->name('career.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/links', [LinkController::class, 'index'])->name('links');
Route::post('/contact', [PageController::class, 'submitContact'])->name('contact.submit');
Route::post('/careers/{slug}/apply', [PageController::class, 'applyCareer'])->name('career.apply');

Auth::routes();

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource('services', App\Http\Controllers\ServiceController::class);
    Route::resource('blogs', App\Http\Controllers\BlogController::class);
    Route::resource('industries', App\Http\Controllers\IndustryController::class);
    Route::resource('careers', App\Http\Controllers\CareerController::class);
    Route::resource('team-members', App\Http\Controllers\TeamMemberController::class);
    Route::resource('banners', App\Http\Controllers\BannerController::class);
    Route::resource('testimonials', App\Http\Controllers\TestimonialController::class);
    Route::get('site-settings', [App\Http\Controllers\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('site-settings', [App\Http\Controllers\SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::get('links', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('links', [LinkController::class, 'update'])->name('links.update');
    Route::get('contact-enquiries', [App\Http\Controllers\ContactEnquiryController::class, 'index'])->name('contact-enquiries.index');
    Route::patch('contact-enquiries/{contactEnquiry}/status', [App\Http\Controllers\ContactEnquiryController::class, 'updateStatus'])->name('contact-enquiries.status');
    Route::get('job-applications', [App\Http\Controllers\JobApplicationController::class, 'index'])->name('job-applications.index');
    Route::patch('job-applications/{jobApplication}/status', [App\Http\Controllers\JobApplicationController::class, 'updateStatus'])->name('job-applications.status');
});
