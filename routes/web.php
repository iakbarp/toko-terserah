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

Auth::routes();

Route::group(['prefix' => 'faq'],function(){
    Route::get('/cara_belanja', function () {
     return view('faq.cara_belanja');
    });
    Route::get('/cara_cek_order', function () {
        return view('faq.cara_cek_order');
    });
    Route::get('/cara_daftar_akun', function () {
        return view('faq.cara_daftar_akun');
    });
    Route::get('/cara_ganti_password', function () {
        return view('faq.cara_ganti_password');
    });
    Route::get('/cara_menggunakan_voucher', function () {
        return view('faq.cara_menggunakan_voucher');
    });
    Route::get('/cara_mengubah_alamat', function () {
        return view('faq.cara_mengubah_alamat');
    });
    Route::get('/cara_menjadi_member', function () {
        return view('faq.cara_menjadi_member');
    });
    Route::get('/metode_pembayaran', function () {
        return view('faq.metode_pembayaran');
    });
    Route::get('/syarat_dan_ketentuan', function () {
        return view('faq.syarat_dan_ketentuan');
    });
    Route::get('/tentang_kami', function () {
        return view('faq.tentang_kami');
    });
});

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {

    Route::get('cek-username', [
        'uses' => 'RegisterController@cekUsername',
        'as' => 'cek.username'
    ]);

    Route::get('password/reset', [
        'uses' => 'ResetPasswordController@showResetForm',
        'as' => 'password.request'
    ]);

    Route::post('password/reset/submit', [
        'uses' => 'ResetPasswordController@reset',
        'as' => 'password.reset'
    ]);

    Route::post('login', [
        'uses' => 'LoginController@login',
        'as' => 'login'
    ]);

    Route::post('logout', [
        'uses' => 'LoginController@logout',
        'as' => 'logout'
    ]);

    Route::get('activate', [
        'uses' => 'ActivationController@activate',
        'as' => 'activate'
    ]);

    Route::get('login/{provider}', [
        'uses' => 'SocialAuthController@redirectToProvider',
        'as' => 'redirect'
    ]);

    Route::get('login/{provider}/callback', [
        'uses' => 'SocialAuthController@handleProviderCallback',
        'as' => 'callback'
    ]);

});

Route::group(['namespace' => 'Pages'], function () {

    Route::get('/', [
        'uses' => 'MainController@beranda',
        'as' => 'beranda'
    ]);

    Route::group(['prefix' => 'cari'], function () {

        Route::get('/', [
            'uses' => 'CariController@cari',
            'as' => 'cari'
        ]);

        Route::get('data', [
            'uses' => 'CariController@cariData',
            'as' => 'get.cari-data.produk'
        ]);

        Route::get('nama', [
            'uses' => 'CariController@cariNamaProduk',
            'as' => 'get.cari-nama.produk'
        ]);

    });

    Route::group(['prefix' => '{produk}'], function () {

        Route::get('/', [
            'uses' => 'MainController@produk',
            'as' => 'produk'
        ]);

        Route::get('galeri', [
            'uses' => 'MainController@galeriProduk',
            'as' => 'get.galeri.produk'
        ]);

        Route::group(['prefix' => 'wishlist', 'middleware' => ['auth', 'user']], function () {

            Route::get('cek', [
                'uses' => 'MainController@cekWishlist',
                'as' => 'produk.cek.wishlist'
            ]);

            Route::post('add', [
                'uses' => 'MainController@addWishlist',
                'as' => 'produk.add.wishlist'
            ]);

        });

        Route::group(['prefix' => 'cart', 'middleware' => ['auth', 'user', 'user.bio']], function () {

            Route::get('cek', [
                'uses' => 'MainController@cekCart',
                'as' => 'produk.cek.cart'
            ]);

            Route::post('add', [
                'uses' => 'MainController@addCart',
                'as' => 'produk.add.cart'
            ]);

            Route::put('{id}/update', [
                'uses' => 'MainController@updateCart',
                'as' => 'produk.update.cart'
            ]);

            Route::get('{id}/delete', [
                'uses' => 'MainController@deleteCart',
                'as' => 'produk.delete.cart'
            ]);

        });

        Route::post('ulasan/submit', [
            'uses' => 'MainController@submitUlasan',
            'as' => 'produk.submit.ulasan'
        ]);

        Route::post('qna/submit', [
            'uses' => 'MainController@submitQnA',
            'as' => 'produk.submit.qna'
        ]);

    });

    Route::group(['prefix' => 'info'], function () {

        Route::group(['prefix' => 'tentang-kami'], function () {

            Route::get('/', [
                'uses' => 'InfoController@tentang',
                'as' => 'tentang'
            ]);

            Route::post('testimoni/kirim', [
                'middleware' => 'auth',
                'uses' => 'InfoController@kirimTestimoni',
                'as' => 'kirim.testimoni'
            ]);

            Route::get('testimoni/{id}/hapus', [
                'middleware' => 'auth',
                'uses' => 'InfoController@hapusTestimoni',
                'as' => 'hapus.testimoni'
            ]);

        });

        Route::get('syarat-ketentuan', [
            'uses' => 'InfoController@syaratKetentuan',
            'as' => 'syarat-ketentuan'
        ]);

        Route::get('kebijakan-privasi', [
            'uses' => 'InfoController@kebijakanPrivasi',
            'as' => 'kebijakan-privasi'
        ]);

        Route::group(['prefix' => 'kontak'], function () {

            Route::get('/', [
                'uses' => 'InfoController@kontak',
                'as' => 'kontak'
            ]);

            Route::post('kirim', [
                'uses' => 'InfoController@kirimKontak',
                'as' => 'kirim.kontak'
            ]);

        });

    });

    Route::group(['namespace' => 'Users', 'prefix' => 'akun', 'middleware' => ['auth', 'user']], function () {

        Route::group(['prefix' => 'wishlist'], function () {

            Route::get('/', [
                'uses' => 'UserController@wishlist',
                'as' => 'user.wishlist',
            ]);

            Route::get('{id}/delete', [
                'uses' => 'UserController@deleteWishlist',
                'as' => 'user.delete.wishlist',
            ]);

            Route::get('{cart_id}/add', [
                'uses' => 'UserController@addWishlist',
                'as' => 'user.add.wishlist',
            ]);

            Route::post('mass-add', [
                'uses' => 'UserController@massAddWishlist',
                'as' => 'user.mass-add.wishlist',
            ]);

            Route::get('mass-delete', [
                'uses' => 'UserController@massDeleteWishlist',
                'as' => 'user.mass-delete.wishlist',
            ]);

        });

        Route::group(['prefix' => 'cart'], function () {

            Route::get('/', [
                'uses' => 'UserController@cart',
                'as' => 'user.cart',
            ]);

            Route::get('mass-add', [
                'middleware' => 'user.bio',
                'uses' => 'UserController@massAddCart',
                'as' => 'user.mass-add.cart',
            ]);

            Route::post('mass-delete', [
                'middleware' => 'user.bio',
                'uses' => 'UserController@massDeleteCart',
                'as' => 'user.mass-delete.cart',
            ]);

            Route::group(['prefix' => 'checkout', 'middleware' => 'user.bio'], function () {

                Route::post('/', [
                    'uses' => 'UserController@cartCheckout',
                    'as' => 'user.cart.checkout',
                ]);

                Route::get('cari/promo', [
                    'uses' => 'UserController@cariPromo',
                    'as' => 'get.cari-promo.cart'
                ]);

            });

        });

        Route::group(['prefix' => 'dashboard'], function () {

            Route::get('/', [
                'uses' => 'UserController@dashboard',
                'as' => 'user.dashboard'
            ]);

            Route::get('{code}/download', [
                'middleware' => 'user.bio',
                'uses' => 'UserController@downloadFile',
                'as' => 'user.download.file'
            ]);

            Route::get('{code}/received', [
                'middleware' => 'user.bio',
                'uses' => 'UserController@received',
                'as' => 'user.received'
            ]);

            Route::get('{code}/reorder', [
                'middleware' => 'user.bio',
                'uses' => 'UserController@reorder',
                'as' => 'user.reorder'
            ]);

        });

        Route::group(['prefix' => 'sunting-profil'], function () {

            Route::get('/', [
                'uses' => 'AkunController@profil',
                'as' => 'user.profil'
            ]);

            Route::put('update', [
                'uses' => 'AkunController@updateProfil',
                'as' => 'user.update.profil'
            ]);

            Route::post('address/create', [
                'uses' => 'AkunController@createProfilAddress',
                'as' => 'user.profil-alamat.create'
            ]);

            Route::put('address/{id}/update', [
                'uses' => 'AkunController@updateProfilAddress',
                'as' => 'user.profil-alamat.update'
            ]);

            Route::get('address/{id}/delete', [
                'uses' => 'AkunController@deleteProfilAddress',
                'as' => 'user.profil-alamat.delete'
            ]);

        });

        Route::group(['prefix' => 'pengaturan'], function () {

            Route::get('/', [
                'uses' => 'AkunController@pengaturan',
                'as' => 'user.pengaturan'
            ]);

            Route::get('membership', [
                'uses' => 'AkunController@pengaturanMembership',
                'as' => 'user.pengaturan.membership'
            ]);

            Route::put('update', [
                'uses' => 'AkunController@updatePengaturan',
                'as' => 'user.update.pengaturan'
            ]);

        });

    });

});
