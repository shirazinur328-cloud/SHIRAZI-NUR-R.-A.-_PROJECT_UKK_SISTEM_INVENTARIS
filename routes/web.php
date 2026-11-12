<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Locale Switch Route
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::get('/', function() {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'auth_login_form'])->name('login');
Route::post('/login', [AuthController::class, 'auth_login'])->name('login.post');

Route::get('/logout', [AuthController::class, 'auth_logout'])->name('logout')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard_index'])->name('dashboard');

    Route::prefix('categories')->name('categories.')->group(function () {  
        Route::get('/', [CategoryController::class, 'category_index'])->name('index');  
        Route::match(['get', 'post'], '/add', [CategoryController::class, 'category_add'])->name('add');  
        Route::match(['get', 'post'], '{category:slug}/edit', [CategoryController::class, 'category_edit'])->name('edit');  
        Route::post('{category:slug}/delete', [CategoryController::class, 'category_delete'])->name('delete');  
        Route::get('{category:slug}', [CategoryController::class, 'category_detail'])->name('detail');  
    });  

    Route::prefix('locations')->name('locations.')->group(function () {
        Route::get('/', [LocationController::class, 'location_index'])->name('index');
        Route::match(['get', 'post'], '/add', [LocationController::class, 'location_add'])->name('add');
        Route::match(['get', 'post'], '{location:slug/edit', [LocationController::class, 'location_edit'])->name('edit');
        Route::post('{location:slug}/delete', [LocationController::class, 'location_delete'])->name('delete');
        Route::get('{location:slug}', [LocationController::class, 'location_detail'])->name('detail');
    });

    Route::prefix('conditions')->name('conditions.')->group(function () {
        Route::get('/', [ConditionController::class, 'condition_index'])->name('index');
        Route::match(['get', 'post'], '/add', [ConditionController::class, 'condition_add'])->name('add');
        Route::match(['get', 'post'], '{condition:slug/edit', [ConditionController::class, 'condition_edit'])->name('edit');
        Route::post('{condition:slug}/delete', [ConditionController::class, 'condition_delete'])->name('delete');
        Route::get('{condition:slug}', [ConditionController::class, 'condition_detail'])->name('detail');
    });

    Route::prefix('items')->name('items.')->group(function () {
        Route::get('/', [ItemController::class, 'item_index'])->name('index');
        Route::match(['get', 'post'], '/add', [ItemController::class, 'item_add'])->name('add');
        Route::match(['get', 'post'], '{item:slug/edit', [ItemController::class, 'item_edit'])->name('edit');
        Route::post('{item:slug}/delete', [ItemController::class, 'item_delete'])->name('delete');
        Route::get('{item:slug}', [ItemController::class, 'item_detail'])->name('detail');
    });

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'user_index'])->name('index');
        Route::match(['get', 'post'], '/add', [UserController::class, 'user_add'])->name('add');
        Route::match(['get', 'post'], '{user:slug/edit', [UserController::class, 'user_edit'])->name('edit');
        Route::post('{user:slug}/delete', [UserController::class, 'user_delete'])->name('delete');
        Route::get('{user:slug}', [UserController::class, 'user_detail'])->name('detail');
    });



    Route::get('histories/', [HistoryController::class, 'history_index'])->name('histories.index');

    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'report_index'])->name('index');

    });
});

Route::get('/blank', function () {
    return view('pages.blank', ['title' => 'Blank']);
})->name('blank');
    
// error pages
Route::get('/error-404', function () {
    return view('pages.errors.error-404', ['title' => 'Error 404']);
})->name('error-404');


Route::prefix('tailadmin')->group(function () {

    // dashboard pages
    Route::get('/', function () {
        return view('pages.dashboard.ecommerce', ['title' => 'E-commerce Dashboard']);
    })->name('dashboard');
    
    // calender pages
    Route::get('/calendar', function () {
        return view('pages.calender', ['title' => 'Calendar']);
    })->name('calendar');
    
    // profile pages
    Route::get('/profile', function () {
        return view('pages.profile', ['title' => 'Profile']);
    })->name('profile');
    
    // form pages
    Route::get('/form-elements', function () {
        return view('pages.form.form-elements', ['title' => 'Form Elements']);
    })->name('form-elements');
    
    // tables pages
    Route::get('/basic-tables', function () {
        return view('pages.tables.basic-tables', ['title' => 'Basic Tables']);
    })->name('basic-tables');
    
    // pages
    
    Route::get('/blank', function () {
        return view('pages.blank', ['title' => 'Blank']);
    })->name('blank');
    
    // error pages
    Route::get('/error-404', function () {
        return view('pages.errors.error-404', ['title' => 'Error 404']);
    })->name('error-404');
    
    // chart pages
    Route::get('/line-chart', function () {
        return view('pages.chart.line-chart', ['title' => 'Line Chart']);
    })->name('line-chart');
    
    Route::get('/bar-chart', function () {
        return view('pages.chart.bar-chart', ['title' => 'Bar Chart']);
    })->name('bar-chart');
    
    
    // authentication pages
    Route::get('/signin', function () {
        return view('pages.auth.signin', ['title' => 'Sign In']);
    })->name('signin');
    
    Route::get('/signup', function () {
        return view('pages.auth.signup', ['title' => 'Sign Up']);
    })->name('signup');
    
    // ui elements pages
    Route::get('/alerts', function () {
        return view('pages.ui-elements.alerts', ['title' => 'Alerts']);
    })->name('alerts');
    
    Route::get('/avatars', function () {
        return view('pages.ui-elements.avatars', ['title' => 'Avatars']);
    })->name('avatars');
    
    Route::get('/badge', function () {
        return view('pages.ui-elements.badges', ['title' => 'Badges']);
    })->name('badges');
    
    Route::get('/buttons', function () {
        return view('pages.ui-elements.buttons', ['title' => 'Buttons']);
    })->name('buttons');
    
    Route::get('/image', function () {
        return view('pages.ui-elements.images', ['title' => 'Images']);
    })->name('images');
    
    Route::get('/videos', function () {
        return view('pages.ui-elements.videos', ['title' => 'Videos']);
    })->name('videos');
});











