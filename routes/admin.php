<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\{ 
    AuthController,
    DashboardController,
    NavigationController,
    BlogCategoryController,
    BlogsController,
    BlogPostController,
    SpeakerController,
    WebinarController,
    PositionController,
    LifeMerinoController,
    CandidateController,
    TestimonialController,
    WebinarTestimonialController,
    LocationController,
    CountryController,
    BannerController,
    TickerController,
    ResourceController,
    ResourceCategoryController,
    ServiceController,
    ServiceCategoryController,
    IndustryController,
    IndustryCategoryController,
    SolutionController,
    SolutionCategoryController,
    MarketplaceCategoryController,

    ProductController,
    ProductCategoryController,
    NewsController,
    AuthorController,
    EmployeeSpeakController
};

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-post', [AuthController::class, 'login_post'])->name('login.post');
    
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // banners routes
        Route::group(['prefix' => 'banner', 'as' => 'banner.'], function () {
            Route::get('/', [BannerController::class, 'index'])->name('index');
            Route::get('/create', [BannerController::class, 'create'])->name('create');
            Route::post('/store', [BannerController::class, 'store'])->name('store');
            Route::get('/edit/{banner}', [BannerController::class, 'edit'])->name('edit');
            Route::post('/update/{banner}', [BannerController::class, 'update'])->name('update');
            Route::get('/status-update/{banner}', [BannerController::class, 'status_update'])->name('status_update');
            Route::get('/delete/{banner}', [BannerController::class, 'delete'])->name('delete');
        });

        // ticker routes
        Route::group(['prefix' => 'ticker', 'as' => 'ticker.'], function () {
            Route::get('/', [TickerController::class, 'index'])->name('index');
            Route::get('/create', [TickerController::class, 'create'])->name('create');
            Route::post('/store', [TickerController::class, 'store'])->name('store');
            Route::get('/edit/{ticker}', [TickerController::class, 'edit'])->name('edit');
            Route::post('/update/{ticker}', [TickerController::class, 'update'])->name('update');
            Route::get('/status-update/{ticker}', [TickerController::class, 'status_update'])->name('status_update');
            Route::get('/delete/{ticker}', [TickerController::class, 'delete'])->name('delete');
        });

        // speaker routes
        Route::group(['prefix' => 'speaker', 'as' => 'speaker.'], function () {
            Route::get('/', [SpeakerController::class, 'index'])->name('index');
            Route::get('/create', [SpeakerController::class, 'create'])->name('create');
            Route::post('/store', [SpeakerController::class, 'store'])->name('store');
            Route::get('/edit/{speaker}', [SpeakerController::class, 'edit'])->name('edit');
            Route::post('/update/{speaker}', [SpeakerController::class, 'update'])->name('update');
        });

        // webinars routes
        Route::group(['prefix' => 'webinar', 'as' => 'webinar.'], function () {
            Route::get('/', [WebinarController::class, 'index'])->name('index');
            Route::get('/create', [WebinarController::class, 'create'])->name('create');
            Route::post('/store', [WebinarController::class, 'store'])->name('store');
            Route::get('/edit/{webinar}', [WebinarController::class, 'edit'])->name('edit');
            Route::post('/update/{webinar}', [WebinarController::class, 'update'])->name('update');

            Route::get('/users', [WebinarController::class, 'users'])->name('users');
        });

        //Route::get('/test', [DashboardController::class, 'index'])->name('test');

        // Navigation routes
        Route::group(['prefix' => 'navigation', 'as' => 'navigation.'], function () {
            Route::get('/', [NavigationController::class, 'index'])->name('index');
            Route::post('/get-level-1-list', [NavigationController::class, 'get_level_1_list'])->name('get_level_1_list');
            Route::get('/add', [NavigationController::class, 'create'])->name('create');
            Route::post('/store', [NavigationController::class, 'store'])->name('store');
            Route::get('/edit/{navigation}', [NavigationController::class, 'edit'])->name('edit');
            Route::get('/status-update/{navigation}', [NavigationController::class, 'status_update'])->name('status_update');
            Route::post('/update/{navigation}', [NavigationController::class, 'update'])->name('update');
            Route::get('/delete/{navigation}', [NavigationController::class, 'delete'])->name('delete');
        });

        // Blogs categories routes
        Route::group(['prefix' => 'blog-category', 'as' => 'blog-category.'], function () {
            Route::get('/', [BlogCategoryController::class, 'index'])->name('index');
            Route::get('/add', [BlogCategoryController::class, 'create'])->name('create');
            Route::post('/store', [BlogCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{category}', [BlogCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{category}', [BlogCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{category}', [BlogCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{category}', [BlogCategoryController::class, 'delete'])->name('delete');
        });

        // Blogs routes
        Route::group(['prefix' => 'blogs', 'as' => 'blogs.'], function () {
            Route::get('/', [BlogsController::class, 'index'])->name('index');
            Route::get('/add', [BlogsController::class, 'create'])->name('create');
            Route::post('/store', [BlogsController::class, 'store'])->name('store');
            Route::get('/edit/{blog}', [BlogsController::class, 'edit'])->name('edit');
            Route::get('/status-update/{blog}', [BlogsController::class, 'status_update'])->name('status_update');
            Route::post('/update/{blog}', [BlogsController::class, 'update'])->name('update');
            Route::get('/delete/{blog}', [BlogsController::class, 'delete'])->name('delete');
        });

        // Resource routes
        Route::group(['prefix' => 'resource', 'as' => 'resource.'], function () {
            Route::get('/', [ResourceController::class, 'index'])->name('index');
            Route::get('/add', [ResourceController::class, 'create'])->name('create');
            Route::post('/store', [ResourceController::class, 'store'])->name('store');
            Route::get('/edit/{resource}', [ResourceController::class, 'edit'])->name('edit');
            Route::get('/status-update/{resource}', [ResourceController::class, 'status_update'])->name('status_update');
            Route::post('/update/{resource}', [ResourceController::class, 'update'])->name('update');
            Route::get('/delete/{resource}', [ResourceController::class, 'delete'])->name('delete');
        });

        // Resource Category routes
        Route::group(['prefix' => 'resource-category', 'as' => 'resource-category.'], function () {
            Route::get('/', [ResourceCategoryController::class, 'index'])->name('index');
            Route::get('/add', [ResourceCategoryController::class, 'create'])->name('create');
            Route::post('/store', [ResourceCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{resourceCategory}', [ResourceCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{resourceCategory}', [ResourceCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{resourceCategory}', [ResourceCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{resourceCategory}', [ResourceCategoryController::class, 'delete'])->name('delete');
        });

        // BlogPost routes
        Route::group(['prefix' => 'blogpost', 'as' => 'blogpost.'], function () {
            Route::get('/{blog}', [BlogPostController::class, 'index'])->name('index');
            Route::get('/add/{blog}', [BlogPostController::class, 'create'])->name('create');
            Route::post('/store/{blog}', [BlogPostController::class, 'store'])->name('store');
            Route::get('/edit/{blog}/{post}', [BlogPostController::class, 'edit'])->name('edit');
            Route::get('/status-update/{post}', [BlogPostController::class, 'status_update'])->name('status_update');
            Route::post('/update/{blog}/{post}', [BlogPostController::class, 'update'])->name('update');
            Route::get('/delete/{post}', [BlogPostController::class, 'delete'])->name('delete');
        });

        // Positions routes
        Route::group(['prefix' => 'positions', 'as' => 'positions.'], function () {
            Route::get('/', [PositionController::class, 'index'])->name('index');
            Route::get('/add', [PositionController::class, 'create'])->name('create');
            Route::post('/store', [PositionController::class, 'store'])->name('store');
            Route::get('/edit/{position}', [PositionController::class, 'edit'])->name('edit');
            Route::get('/status-update/{position}', [PositionController::class, 'status_update'])->name('status_update');
            Route::post('/update/{position}', [PositionController::class, 'update'])->name('update');
            Route::get('/delete/{position}', [PositionController::class, 'delete'])->name('delete');

            Route::get('/candidates', [CandidateController::class, 'candidates'])->name('candidates');
        });

        // testimonials routes
        Route::group(['prefix' => 'testimonials', 'as' => 'testimonials.'], function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('index');
            Route::get('/add', [TestimonialController::class, 'create'])->name('create');
            Route::post('/store', [TestimonialController::class, 'store'])->name('store');
            Route::get('/edit/{testimonial}', [TestimonialController::class, 'edit'])->name('edit');
            Route::get('/status-update/{testimonial}', [TestimonialController::class, 'status_update'])->name('status_update');
            Route::post('/update/{testimonial}', [TestimonialController::class, 'update'])->name('update');
            Route::get('/delete/{testimonial}', [TestimonialController::class, 'delete'])->name('delete');
        });

        // Webinar testimonials routes
        Route::group(['prefix' => 'webinar-testimonials', 'as' => 'webinar_testimoni.'], function () {
            Route::get('/', [WebinarTestimonialController::class, 'index'])->name('index');
            Route::get('/add', [WebinarTestimonialController::class, 'create'])->name('create');
            Route::post('/store', [WebinarTestimonialController::class, 'store'])->name('store');
            Route::get('/edit/{testimonial}', [WebinarTestimonialController::class, 'edit'])->name('edit');
            Route::get('/status-update/{testimonial}', [WebinarTestimonialController::class, 'status_update'])->name('status_update');
            Route::post('/update/{testimonial}', [WebinarTestimonialController::class, 'update'])->name('update');
            Route::get('/delete/{testimonial}', [WebinarTestimonialController::class, 'delete'])->name('delete');
        });

        // locations routes
        Route::group(['prefix' => 'locations', 'as' => 'locations.'], function () {
            Route::get('/', [LocationController::class, 'index'])->name('index');
            Route::get('/add', [LocationController::class, 'create'])->name('create');
            Route::post('/store', [LocationController::class, 'store'])->name('store');
            Route::get('/edit/{location}', [LocationController::class, 'edit'])->name('edit');
            Route::get('/status-update/{location}', [LocationController::class, 'status_update'])->name('status_update');
            Route::post('/update/{location}', [LocationController::class, 'update'])->name('update');
            Route::get('/delete/{location}', [LocationController::class, 'delete'])->name('delete');
        });

        // country routes
        Route::group(['prefix' => 'country', 'as' => 'country.'], function () {
            Route::get('/', [CountryController::class, 'index'])->name('index');
            Route::get('/add', [CountryController::class, 'create'])->name('create');
            Route::post('/store', [CountryController::class, 'store'])->name('store');
            Route::get('/edit/{country}', [CountryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{country}', [CountryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{country}', [CountryController::class, 'update'])->name('update');
            Route::get('/delete/{country}', [CountryController::class, 'delete'])->name('delete');
        });

        // Services routes
        Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/add', [ServiceController::class, 'create'])->name('create');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::get('/edit/{service}', [ServiceController::class, 'edit'])->name('edit');
            Route::get('/status-update/{service}', [ServiceController::class, 'status_update'])->name('status_update');
            Route::post('/update/{service}', [ServiceController::class, 'update'])->name('update');
            Route::get('/delete/{service}', [ServiceController::class, 'delete'])->name('delete');
        });

        // Services Category routes
        Route::group(['prefix' => 'service-category', 'as' => 'service-category.'], function () {
            Route::get('/', [ServiceCategoryController::class, 'index'])->name('index');
            Route::get('/add', [ServiceCategoryController::class, 'create'])->name('create');
            Route::post('/store', [ServiceCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{serviceCategory}', [ServiceCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{serviceCategory}', [ServiceCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{serviceCategory}', [ServiceCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{serviceCategory}', [ServiceCategoryController::class, 'delete'])->name('delete');
        });

        // industry routes
        Route::group(['prefix' => 'industry', 'as' => 'industry.'], function () {
            Route::get('/', [IndustryController::class, 'index'])->name('index');
            Route::get('/add', [IndustryController::class, 'create'])->name('create');
            Route::post('/store', [IndustryController::class, 'store'])->name('store');
            Route::get('/edit/{industry}', [IndustryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{industry}', [IndustryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{industry}', [IndustryController::class, 'update'])->name('update');
            Route::get('/delete/{industry}', [IndustryController::class, 'delete'])->name('delete');
        });

        // industry Category routes
        Route::group(['prefix' => 'industry-category', 'as' => 'industry-category.'], function () {
            Route::get('/', [IndustryCategoryController::class, 'index'])->name('index');
            Route::get('/add', [IndustryCategoryController::class, 'create'])->name('create');
            Route::post('/store', [IndustryCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{industryCategory}', [IndustryCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{industryCategory}', [IndustryCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{industryCategory}', [IndustryCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{industryCategory}', [IndustryCategoryController::class, 'delete'])->name('delete');
        });

        // solution routes
        Route::group(['prefix' => 'solution', 'as' => 'solution.'], function () {
            Route::get('/', [SolutionController::class, 'index'])->name('index');
            Route::get('/add', [SolutionController::class, 'create'])->name('create');
            Route::post('/store', [SolutionController::class, 'store'])->name('store');
            Route::get('/edit/{solution}', [SolutionController::class, 'edit'])->name('edit');
            Route::get('/status-update/{solution}', [SolutionController::class, 'status_update'])->name('status_update');
            Route::post('/update/{solution}', [SolutionController::class, 'update'])->name('update');
            Route::get('/delete/{solution}', [SolutionController::class, 'delete'])->name('delete');
        });

        // solution Category routes
        Route::group(['prefix' => 'solution-category', 'as' => 'solution-category.'], function () {
            Route::get('/', [SolutionCategoryController::class, 'index'])->name('index');
            Route::get('/add', [SolutionCategoryController::class, 'create'])->name('create');
            Route::post('/store', [SolutionCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{solutionCategory}', [SolutionCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{solutionCategory}', [SolutionCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{solutionCategory}', [SolutionCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{solutionCategory}', [SolutionCategoryController::class, 'delete'])->name('delete');
        });

        // product routes
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/add', [ProductController::class, 'create'])->name('create');
            Route::post('/store', [ProductController::class, 'store'])->name('store');
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit');
            Route::get('/status-update/{product}', [ProductController::class, 'status_update'])->name('status_update');
            Route::post('/update/{product}', [ProductController::class, 'update'])->name('update');
            Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('delete');
        });

        // product Category routes
        Route::group(['prefix' => 'product-category', 'as' => 'product-category.'], function () {
            Route::get('/', [ProductCategoryController::class, 'index'])->name('index');
            Route::get('/add', [ProductCategoryController::class, 'create'])->name('create');
            Route::post('/store', [ProductCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{productCategory}', [ProductCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{productCategory}', [ProductCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{productCategory}', [ProductCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{productCategory}', [ProductCategoryController::class, 'delete'])->name('delete');
        });

        // marketplace Category routes
        Route::group(['prefix' => 'marketplace-category', 'as' => 'marketplace-category.'], function () {
            Route::get('/', [MarketplaceCategoryController::class, 'index'])->name('index');
            Route::get('/add', [MarketplaceCategoryController::class, 'create'])->name('create');
            Route::post('/store', [MarketplaceCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{marketplaceCategory}', [MarketplaceCategoryController::class, 'edit'])->name('edit');
            Route::get('/status-update/{marketplaceCategory}', [MarketplaceCategoryController::class, 'status_update'])->name('status_update');
            Route::post('/update/{marketplaceCategory}', [MarketplaceCategoryController::class, 'update'])->name('update');
            Route::get('/delete/{marketplaceCategory}', [MarketplaceCategoryController::class, 'delete'])->name('delete');
        });

        

        // news routes
        Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('/add', [NewsController::class, 'create'])->name('create');
            Route::post('/store', [NewsController::class, 'store'])->name('store');
            Route::get('/edit/{news}', [NewsController::class, 'edit'])->name('edit');
            Route::get('/status-update/{news}', [NewsController::class, 'status_update'])->name('status_update');
            Route::post('/update/{news}', [NewsController::class, 'update'])->name('update');
            Route::get('/delete/{news}', [NewsController::class, 'delete'])->name('delete');
        });

        // author routes
        Route::group(['prefix' => 'author', 'as' => 'author.'], function () {
            Route::get('/', [AuthorController::class, 'index'])->name('index');
            Route::get('/add', [AuthorController::class, 'create'])->name('create');
            Route::post('/store', [AuthorController::class, 'store'])->name('store');
            Route::get('/edit/{author}', [AuthorController::class, 'edit'])->name('edit');
            Route::get('/status-update/{author}', [AuthorController::class, 'status_update'])->name('status_update');
            Route::post('/update/{author}', [AuthorController::class, 'update'])->name('update');
            Route::get('/delete/{author}', [AuthorController::class, 'delete'])->name('delete');
        });

        // Life@Merino routes
        Route::group(['prefix' => 'life-at-merino', 'as' => 'life_merino.'], function () {
            Route::get('/', [LifeMerinoController::class, 'index'])->name('index');
            Route::get('/add', [LifeMerinoController::class, 'create'])->name('create');
            Route::post('/store', [LifeMerinoController::class, 'store'])->name('store');
            Route::get('/edit/{life_merino}', [LifeMerinoController::class, 'edit'])->name('edit');
            Route::get('/status-update/{life_merino}', [LifeMerinoController::class, 'status_update'])->name('status_update');
            Route::post('/update/{life_merino}', [LifeMerinoController::class, 'update'])->name('update');
            Route::get('/delete/{life_merino}', [LifeMerinoController::class, 'delete'])->name('delete');
        });

        // EmployeeSpeak routes
        Route::group(['prefix' => 'employee-speak', 'as' => 'employee-speak.'], function () {
            Route::get('/', [EmployeeSpeakController::class, 'index'])->name('index');
            Route::get('/add', [EmployeeSpeakController::class, 'create'])->name('create');
            Route::post('/store', [EmployeeSpeakController::class, 'store'])->name('store');
            Route::get('/edit/{employee_speak}', [EmployeeSpeakController::class, 'edit'])->name('edit');
            Route::get('/status-update/{employee_speak}', [EmployeeSpeakController::class, 'status_update'])->name('status_update');
            Route::post('/update/{employee_speak}', [EmployeeSpeakController::class, 'update'])->name('update');
            Route::get('/delete/{employee_speak}', [EmployeeSpeakController::class, 'delete'])->name('delete');
        });

        

    });    
})->middleware('admin');;





