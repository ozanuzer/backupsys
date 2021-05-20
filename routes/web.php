<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Auth')->group(function () {
    Route::get('/login','LoginController@show_login_form')->name('login');
    Route::post('/login','LoginController@process_login')->name('login');
    //Route::get('/register','LoginController@show_signup_form')->name('register');
    //Route::post('/register','LoginController@process_signup');
    Route::get('/logout','LoginController@logout')->name('logout');
  });

Route::group(['middleware' => 'admin'], function()
{
    Route::prefix('panel')->group(function () {
        Route::get('/', 'Panel\DashboardController@index')->name('dashboard');
/*
        //Models
        Route::get('/models/women', 'Panel\ModelsController@women')->name('panel.models.women');
        Route::get('/models/man', 'Panel\ModelsController@man')->name('panel.models.man');
        Route::get('/models/intown', 'Panel\ModelsController@intown')->name('panel.models.intown');
        Route::get('/models/timeless', 'Panel\ModelsController@timeless')->name('panel.models.timeless');
        Route::post('/models/{type}/ajaxget', 'Panel\ModelsController@getwomen')->name('panel.models.ajaxget');
        Route::get('/models/new/{type}', 'Panel\ModelsController@createmodel')->name('panel.models.create');
        Route::post('/models/new', 'Panel\ModelsController@storemodel')->name('panel.models.store');
        Route::get('/models/edit/{id}/{type}', 'Panel\ModelsController@editwomen')->name('panel.models.edit');
        Route::post('/models/update/{id}', 'Panel\ModelsController@updatewomen')->name('panel.models.update');
        Route::get('/models/delete/{id}', 'Panel\ModelsController@deletemodel')->name('panel.models.delete');
        Route::get('/models/active/{id}', 'Panel\ModelsController@activemodel')->name('panel.models.active');
        Route::get('/models/up/{id}', 'Panel\ModelsController@upmodel')->name('panel.models.up');
        Route::get('/models/down/{id}', 'Panel\ModelsController@downmodel')->name('panel.models.down');
        Route::get('/models/inup/{id}', 'Panel\ModelsController@inupmodel')->name('panel.models.inup');
        Route::get('/models/indown/{id}', 'Panel\ModelsController@indownmodel')->name('panel.models.indown');
        Route::get('/models/tmup/{id}', 'Panel\ModelsController@tmupmodel')->name('panel.models.tmup');
        Route::get('/models/tmdown/{id}', 'Panel\ModelsController@tmdownmodel')->name('panel.models.tmdown');
        Route::get('/models/resortfix', 'Panel\ModelsController@resortintown')->name('panel.models.resortintown');

        //Gallery
        Route::get('/models/{id}/gallery', 'Panel\GalleryController@index')->name('models.gallery');
        Route::post('/models/{id}/gallery/ajaxget', 'Panel\GalleryController@ajaxgallery')->name('models.gallery.ajaxget');
        Route::get('/models/{id}/gallery/new', 'Panel\GalleryController@creategallery')->name('models.gallery.create');
        Route::post('/models/{id}/gallery/new', 'Panel\GalleryController@storegallery')->name('models.gallery.store');
        Route::get('/models/{id}/gallery/makemain/{gid}', 'Panel\GalleryController@makemaingallery')->name('models.gallery.makemain');
        Route::get('/models/{id}/gallery/delete/{gid}', 'Panel\GalleryController@deletegallery')->name('models.gallery.delete');

        //Poloraid
        Route::get('/models/{id}/poloraid', 'Panel\PoloraidController@index')->name('models.poloraid');
        Route::post('/models/{id}/poloraid/ajaxget', 'Panel\PoloraidController@ajaxgallery')->name('models.poloraid.ajaxget');
        Route::get('/models/{id}/poloraid/new', 'Panel\PoloraidController@creategallery')->name('models.poloraid.create');
        Route::post('/models/{id}/poloraid/new', 'Panel\PoloraidController@storegallery')->name('models.poloraid.store');
        Route::get('/models/{id}/poloraid/delete/{gid}', 'Panel\PoloraidController@deletegallery')->name('models.poloraid.delete');

        //Sedcard
        Route::get('/models/{id}/sedcard', 'Panel\SedcardController@index')->name('models.sedcard');
        Route::post('/models/{id}/sedcard/ajaxget', 'Panel\SedcardController@ajaxgallery')->name('models.sedcard.ajaxget');
        Route::get('/models/{id}/sedcard/new', 'Panel\SedcardController@creategallery')->name('models.sedcard.create');
        Route::post('/models/{id}/sedcard/new', 'Panel\SedcardController@storegallery')->name('models.sedcard.store');
        Route::get('/models/{id}/sedcard/delete/{gid}', 'Panel\SedcardController@deletegallery')->name('models.sedcard.delete');

        //Slider
        Route::get('/slider', 'Panel\SliderController@index')->name('panel.slider');
        Route::post('/slider', 'Panel\SliderController@store')->name('panel.slider.store');

        //Bülten
        Route::get('/news', 'Panel\NewsController@index')->name('panel.news');
        Route::post('/news/ajaxget', 'Panel\NewsController@ajaxget')->name('panel.news.ajaxget');
        Route::get('/news/create', 'Panel\NewsController@create')->name('panel.news.create');
        Route::post('/news/store', 'Panel\NewsController@store')->name('panel.news.store');
        Route::get('/news/edit/{id}', 'Panel\NewsController@edit')->name('panel.news.edit');
        Route::post('/news/edit/{id}', 'Panel\NewsController@update')->name('panel.news.update');
        Route::get('/news/delete/{id}', 'Panel\NewsController@delete')->name('panel.news.update');
        Route::get('/news/up/{id}', 'Panel\NewsController@upmodel')->name('panel.news.up');
        Route::get('/news/down/{id}', 'Panel\NewsController@downmodel')->name('panel.news.down');
        Route::get('/news/active/{id}', 'Panel\NewsController@activemodel')->name('panel.news.active');

        //Bülten Gallery
        Route::get('/news/{id}/gallery', 'Panel\NewsgalleryController@index')->name('panel.news.gallery');
        Route::post('/news/{id}/gallery/ajaxget', 'Panel\NewsgalleryController@ajaxget')->name('panel.news.gallery.ajaxget');
        Route::get('/news/{id}/gallery/new', 'Panel\NewsgalleryController@create')->name('panel.news.gallery.create');
        Route::post('/news/{id}/gallery/new', 'Panel\NewsgalleryController@store')->name('panel.news.gallery.store');
        Route::get('/news/{id}/gallery/makemain/{gid}', 'Panel\NewsgalleryController@makemain')->name('panel.news.gallery.makemain');
        Route::get('/news/{id}/gallery/delete/{gid}', 'Panel\NewsgalleryController@delete')->name('panel.news.gallery.delete');*/
    });
});

Route::get('/', function () {
    return view('welcome');
});
