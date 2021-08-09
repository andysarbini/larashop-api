<?php

use Illuminate\Http\Request;
// use App\Book;
// use App\Http\Resources\Book as BookResource;
// use App\Http\Resources\BookCollection as BookCollectionResource;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('nama', function() {
    return 'Namaku, Larashop API';
});

Route::post('umur', function() {
    return 17;
});

Route::get('category/{id?}', function ($id=null) {
    $categories = [
        1 => 'Programming',
        2 => 'Desain Grafis',
        3 => 'Jaringan Komputer',
    ];
    $id = (int) $id;
    if($id==0) return 'Silahkan pilih kategori';
    else return 'Anda memilih kategori <b>'.$categories[$id].'</b>';
});

Route::get('book', function() {
    return new BookResource(Book::find(2));
});


// grouping
Route::prefix('v1')->group(function() {

    // Route::get('books', function() {
    //     return new BookCollectionResource(Book::get());
    // });
    // Route::get('book/{id}', function() {
    //     // Match dengan "/v1/books"
    //     return 'buku angka';
    // })->where('id', '[0-9]+');
    
    // Route::get('book/{title}', function($title) {
    //     // Match dengan "/v1/books"
    //     return 'buku abjad';
    // })->where('id', '[A-Za-z]+');
    Route::middleware(['cors'])->options('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    // Route::post('logout', 'AuthController@logout');

    Route::middleware(['cors'])->get('categories', 'CategoryController@index');
    Route::get('categories/{id}', 'CategoryController@view')->where('id', '[0-9]+');
    Route::middleware(['cors'])->get('categories/random/{count}', 'CategoryController@random');
    Route::middleware(['cors'])->get('categories/slug/{slug}', 'CategoryController@slug');

    Route::middleware(['cors'])->get('books', 'BookController@index');  
    Route::get('book/{id}', 'BookController@view')->where('id', '[0-9]+');
    Route::middleware(['cors'])->get('books/top/{count}', 'BookController@top');
    Route::get('books_all', 'BookController@all');
    Route::middleware(['cors'])->get('books/slug/{slug}', 'BookController@slug');
    Route::middleware(['cors'])->get('books/search/{keyword}', 'BookController@search');
    

    // Route::get('categories', function() {
    //     // Match dengan "/v1/books"
    //     // public
    // });    

    // private
    Route::middleware(['auth:api'])->group(function() {
        Route::post('logout', 'AuthController@logout');
    });

});

Route::get('buku/{judul}', 'BookController@cetak');

// Rate limiting, middleware utk membatasi akses ke suatu routing tertentu menggunakan throttle sebanyak 10x
Route::middleware('throttle:10,1')->group(function() { 
    Route::get('buku/{judul}', 'BookController@cetak');
});

// Route::get('/book', function(){
//     return new BookResource(Book::find(1));
// });

//Route::resource('categories', 'CategoryController');  daftarkan semua method di controller category

// routing semua method kecuali create and update krn utk API
Route::apiResources([
    'categories' => 'CategoryController',
    'books' => 'BookController'
]);
