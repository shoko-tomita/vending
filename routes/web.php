        <?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\auth\AuthController;
        use App\Http\Controllers\ProductController;
        use App\Http\Controllers\UploadController;

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
            // 削除機能
            Route::post('/vending_all/{id}', [ProductController::class, 'destroy'])->name('delete');

            // 商品登録
            Route::get('/create',  [ProductController::class, 'showCreate'])->name('create');
            Route::post('/create', [ProductController::class, 'newCreate'])->name('newcreate');

            // Route::post('upload',ProductController::class,'upLoad');

            // 商品詳細
            Route::get('/disp/{id}',  [ProductController::class, 'showDisp'])->name('disp');

            // 商品情報編集のルーティング
            Route::get('/edit/{id}', [ProductController::class, 'showEdit'])->name('edit');
            // 更新処理
            Route::post('/edit/update/{id}', [ProductController::class, 'update'])->name('update');
            // 検索機能
            Route::get('/search', [ProductController::class, 'search'])->name('search');
            // 検索機能
            Route::post('/list', [ProductController::class, 'list'])->name('list');

        });
        require __DIR__ . '/auth.php';
