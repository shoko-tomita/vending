        <?php

        use Illuminate\Support\Facades\Route;
        use App\Http\Controllers\auth\AuthController;
        use App\Http\Controllers\ProductController;
        use App\Http\Controllers\UploadController;
        use App\Http\Controllers\PasswordController;
        use App\Http\Controllers\CompanyController;

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


        // パスワードリセット関連
        Route::prefix('password_reset')->name('password_reset.')->group(function () {
            Route::prefix('email')->name('email.')->group(function () {
                // パスワードリセットメール送信フォームページ
                Route::get('/', [PasswordController::class, 'emailFormResetPassword'])->name('form');
                // メール送信処理
                Route::post('/', [PasswordController::class, 'sendEmailResetPassword'])->name('send');
                // メール送信完了ページ
                Route::get('/send_complete', [PasswordController::class, 'sendComplete'])->name('send_complete');
            });
            // パスワード再設定ページ
            Route::get('/edit', [PasswordController::class, 'edit'])->name('edit');
            // パスワード更新処理
            Route::post('/update', [PasswordController::class, 'update'])->name('update');
            // パスワード更新終了ページ
            Route::get('/edited', [PasswordController::class, 'edited'])->name('edited');
        });

        Route::group(['middleware' => ['guest']], function () {
            // ログインフォーム表示
            Route::get('/', [AuthController::class, 'showLogin'])->name('login.show');
            // ログイン処理
            Route::post('login', [AuthController::class, 'login'])->name('login');
        });

        Route::group(['middleware' => ['auth']], function () {
    // 商品ページ //
            // 一覧画面
            Route::get('vending_all', [ProductController::class, 'show'])->name('vending_all');
            // 削除機能
            Route::post('/vending_all/{id}', [ProductController::class, 'destroy'])->name('delete');

            // 商品登録
            Route::get('/create',  [ProductController::class, 'showCreate'])->name('create');
            Route::post('/create', [ProductController::class, 'newCreate'])->name('newcreate');

            // 画像アップロード
            Route::resource('/upload',UploadController::class);

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


        // 企業ページ //
                // 一覧画面
                Route::get('all', [CompanyController::class, 'show'])->name('all');
                // 商品登録
                Route::get('/comapny_create',  [CompanyController::class, 'showCreate'])->name('create2');
                Route::post('/company_create', [CompanyController::class, 'newCreate'])->name('newcreate2');
                // // 商品詳細
                // Route::get('/company_disp/{id}',  [CompanyController::class, 'showDisp'])->name('disp');
                // 商品情報編集のルーティング
                Route::get('/company_edit/{id}', [CompanyController::class, 'showEdit'])->name('edit2');
                // // 更新処理
                Route::post('/company_edit/up/{id}', [CompanyController::class, 'up'])->name('up');

        });
        require __DIR__ . '/auth.php';
