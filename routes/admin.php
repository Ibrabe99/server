<?php

use App\Http\Controllers\Admin\Add_mealController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguagesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\MainCategoriesController;
use App\Http\Controllers\Admin\SubCategoriesController;
use App\Http\Controllers\Admin\VendorsController;
use App\Models\Add_meal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;







//,'middleware' => [,'auth:admin','Admin']

// مجموعة المسارات للمستخدمين المسجلين (Admins)
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin','middleware' => ['web','auth:admin','Admin']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');




    //////////////////###################  Begin Languages Route  ###################//////////////////

    Route::group(['prefix'=> 'languages'],function(){
        Route::get('/',[LanguagesController::class,'index'])->name('admin.languages');

                   ##################### create #####################
        Route::get('create',[LanguagesController::class,'create'])->name('admin.languages.create');
        Route::post('store',[LanguagesController::class,'store'])->name('admin.languages.store');

                   #####################  edit  #####################
        Route::get('edit/{id}',[LanguagesController::class,'edit'])->name('admin.languages.edit');
        Route::post('update/{id}',[LanguagesController::class,'update'])->name('admin.languages.update');
                  ##################### delete #####################
        Route::get('languages/{id}', [LanguagesController::class, 'delete'])->name('admin.languages.delete');


    });

    //////////////////###################  End  Languages  Route  ###################//////////////////





        //////////////////###################  Begin Main Categoris Route  ###################//////////////////

        Route::group(['prefix'=> 'main_categories'],function(){
            Route::get('/',[MainCategoriesController::class,'index'])->name('admin.maincategories');

                       ##################### create #####################
            Route::get('create',[MainCategoriesController::class,'create'])->name('admin.maincategories.create');
            Route::post('store',[MainCategoriesController::class,'store'])->name('admin.maincategories.store');

                       #####################  edit  #####################
            Route::get('edit/{id}',[MainCategoriesController::class,'edit'])->name('admin.maincategories.edit');
            Route::post('update/{id}',[MainCategoriesController::class,'update'])->name('admin.maincategories.update');


                      ##################### delete #####################
            Route::get('maincategories/{id}', [MainCategoriesController::class, 'delete'])->name('admin.maincategories.delete');



                     ##################### changeStatus #####################
            Route::get('changeStatus/{id}', [MainCategoriesController::class, 'changeStatus'])->name('admin.maincategories.status');

    });

        //////////////////###################  End  Main Categoris  Route  ###################//////////////////





       //////////////////###################  Begin Sub Categoris Route  ###################//////////////////

        Route::group(['prefix'=> 'sub_categories'],function(){
            Route::get('/',[SubCategoriesController::class,'index'])->name('admin.subcategories');

            ##################### create #####################
            Route::get('create',[SubCategoriesController::class,'create'])->name('admin.subcategories.create');
            Route::post('store',[SubCategoriesController::class,'store'])->name('admin.subcategories.store');

            #####################  edit  #####################
            Route::get('edit/{id}',[SubCategoriesController::class,'edit'])->name('admin.subcategories.edit');
            Route::post('update/{id}',[SubCategoriesController::class,'update'])->name('admin.subcategories.update');


            ##################### delete #####################
            Route::get('delete/{id}', [SubCategoriesController::class, 'delete'])->name('admin.subcategories.delete');

            ##################### changeStatus #####################
            Route::get('changeStatus/{id}', [MainCategoriesController::class, 'changeStatus'])->name('admin.subcategories.status');


        });

      //////////////////###################  End  Sub Categoris  Route  ###################//////////////////



    //////////////////###################  Begin Vendors Route  ###################//////////////////

    Route::group(['prefix'=> 'vendors'],function(){
        Route::get('/',[VendorsController::class,'index'])->name('admin.vendors');

        ##################### create #####################
        Route::get('create',[VendorsController::class,'create'])->name('admin.vendors.create');
        Route::post('store',[VendorsController::class,'store'])->name('admin.vendors.store');

        #####################  edit  #####################
        Route::get('edit/{id}',[VendorsController::class,'edit'])->name('admin.vendors.edit');
        Route::post('update/{id}',[VendorsController::class,'update'])->name('admin.vendors.update');


        ##################### delete #####################
        Route::get('subcategory/{id}', [VendorsController::class, 'delete'])->name('admin.vendors.delete');

        ##################### changeStatus #####################
        Route::get('changeStatus/{id}', [MainCategoriesController::class, 'changeStatus'])->name('admin.vendors.status');


    });

    //////////////////###################  End  Vendors  Route  ###################//////////////////




    //////////////////###################  Begin meals Route  ###################//////////////////

    Route::group(['prefix'=> 'meals'],function(){
        Route::get('/',[Add_mealController::class,'index'])->name('admin.meals');

        ##################### create #####################
        Route::get('create',[Add_mealController::class,'create'])->name('admin.meals.create');
        Route::post('store',[Add_mealController::class,'store'])->name('admin.meals.store');

        #####################  edit  #####################
        Route::get('edit/{id}',[Add_mealController::class,'edit'])->name('admin.meals.edit');
        Route::post('update/{id}',[Add_mealController::class,'update'])->name('admin.meals.update');


        ##################### delete #####################
        Route::get('meals/{id}', [Add_mealController::class, 'delete'])->name('admin.meals.delete');

        ##################### changeStatus #####################
        Route::get('changeStatus/{id}', [MainCategoriesController::class, 'changeStatus'])->name('admin.meals.status');


    });

    //////////////////###################  End  meals  Route  ###################//////////////////
});






// مجموعة المسارات للزوار (Guests)
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => 'web','guest:admin'], function () {


           ##################### Login #####################

    Route::get('login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('admin.login');


     ##################### Logout #####################

    Route::get('logout', [LogoutController::class, 'logout'])->name('logout');


});



