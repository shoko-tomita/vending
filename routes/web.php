        <?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\auth\AuthController;
        use App\Http\Controllers\ProductController;

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


        Route::group(['middleware' => ['guest']], function () {
            // ログインフォーム表示
            Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
            // ログイン処理
            Route::post('login', [AuthController::class, 'login'])->name('login');
        });

        Route::group(['middleware' => ['auth']], function () {
            // 一覧画面
            Route::get('vending_all', [ProductController::class, 'show'])->name('vending_all');

            // 商品登録
            Route::get('/create',  [ProductController::class, 'showCreate'])->name('create');
            // Route::post('/create', [VendingController::class, 'create'])->name('create');
            // Route::post('/create', 'ThreadController@create');

            // 商品詳細
            Route::get('/disp/{id}',  [ProductController::class, 'showDisp'])->name('disp');

            // 商品情報編集のルーティング
            Route::get('/edit/{id}', [ProductController::class, 'showEdit'])->name('edit');
            // 更新処理
            Route::post('/edit/{id}', [ProductController::class, 'update'])->name('update');
        });

        // 詳細ページ
        // Route::get('/vending_disp');

        // Route::get('/disp/{id}', 'ThreadController@show')->name('threads.disp');

        // 商品情報編集のルーティング
        // Route::get('disp/{id}', 'ThreadController@ThreadEdit')->name('threads.edit');
        // Route::post('disp/{id}', 'ThreadController@ThreadUpdate')->name('threads.update');

        // 商品情報作成のルーティング
        // Route::get('/create', 'ThreadController@showCreateForm')->name('threads.create');
        // Route::post('/create', 'ThreadController@create');

        require __DIR__ . '/auth.php';
