<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\Admin\BlogArchiveController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/blogs', [PageController::class, 'blogs'])->name('blogs');
Route::get('/blogs/category/{slug}', [PageController::class, 'blogCategory'])->name('blog.category');
Route::get('/blogs/tag/{slug}', [PageController::class, 'blogTag'])->name('blog.tag');
Route::get('/blogs/archive/{slug}', [PageController::class, 'blogArchive'])->name('blog.archive');
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
    Route::resource('topics', App\Http\Controllers\Admin\TopicController::class);
    Route::resource('topic-posts', App\Http\Controllers\Admin\TopicPostController::class);
    Route::resource('blog-categories', App\Http\Controllers\Admin\BlogCategoryController::class);
    Route::resource('blog-tags', App\Http\Controllers\Admin\BlogTagController::class);
    Route::resource('blogs', App\Http\Controllers\BlogController::class);
    Route::resource('careers', App\Http\Controllers\CareerController::class);
    Route::resource('team-members', App\Http\Controllers\TeamMemberController::class);
    // Blog Archives
    Route::resource('blog-archives', BlogArchiveController::class);

    // Banners
    Route::resource('banners', App\Http\Controllers\BannerController::class);
    Route::resource('service-categories', App\Http\Controllers\Admin\ServiceCategoryController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('industries', App\Http\Controllers\Admin\IndustryController::class);
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
    Route::get('services/{service}/content', [App\Http\Controllers\Admin\ServiceController::class, 'content'])->name('services.content');
    
    Route::resource('service-sections', App\Http\Controllers\Admin\ServiceSectionController::class)->except(['index', 'show']);
    Route::resource('service-faqs', App\Http\Controllers\Admin\ServiceFaqController::class)->except(['index', 'show']);
    Route::resource('service-documents', App\Http\Controllers\Admin\ServiceDocumentController::class)->except(['index', 'show']);
    Route::resource('service-process-steps', App\Http\Controllers\Admin\ServiceProcessStepController::class)->except(['index', 'show']);
    Route::get('site-settings', [App\Http\Controllers\SiteSettingController::class, 'index'])->name('site-settings.index');
    Route::post('site-settings', [App\Http\Controllers\SiteSettingController::class, 'update'])->name('site-settings.update');
    Route::get('links', [LinkController::class, 'edit'])->name('links.edit');
    Route::put('links', [LinkController::class, 'update'])->name('links.update');
    Route::get('contact-enquiries', [App\Http\Controllers\ContactEnquiryController::class, 'index'])->name('contact-enquiries.index');
    Route::patch('contact-enquiries/{contactEnquiry}/status', [App\Http\Controllers\ContactEnquiryController::class, 'updateStatus'])->name('contact-enquiries.status');
    Route::get('job-applications', [App\Http\Controllers\JobApplicationController::class, 'index'])->name('job-applications.index');
    Route::patch('job-applications/{jobApplication}/status', [App\Http\Controllers\JobApplicationController::class, 'updateStatus'])->name('job-applications.status');
});

Route::get('/topic-post/{slug}', [PageController::class, 'topicPost'])->name('topic.post.show');

Route::get('/services', [App\Http\Controllers\ServicesPortalController::class, 'index'])->name('services.index');
Route::get('/services/{category_slug}', [App\Http\Controllers\ServicesPortalController::class, 'category'])->name('services.category');
Route::get('/services/{category_slug}/{service_slug}', [App\Http\Controllers\ServicesPortalController::class, 'show'])->name('services.show');

Route::get('/{slug}', [PageController::class, 'topic'])->name('topic.show');
