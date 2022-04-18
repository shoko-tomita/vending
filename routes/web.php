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

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/vending_all', function () {
        return view('vending_all');
    })->middleware(['auth'])->name('vending_all');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->middleware(['auth'])->name('dashboard');

    // 詳細ページ
    // Route::get('/vending_disp');

    // Route::get('/disp/{id}', 'ThreadController@show')->name('threads.disp');

    // 商品情報編集のルーティング
    // Route::get('disp/{id}', 'ThreadController@ThreadEdit')->name('threads.edit');
    // Route::post('disp/{id}', 'ThreadController@ThreadUpdate')->name('threads.update');

    // 商品情報作成のルーティング
    // Route::get('/create', 'ThreadController@showCreateForm')->name('threads.create');
    // Route::post('/create', 'ThreadController@create');


    require __DIR__.'/auth.php';
