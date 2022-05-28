<?php

namespace App\Providers;

use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('rupiah', function ($money) {
            return "<?php echo 'Rp ' . number_format($money,  0, ',', '.'); ?>";
        });

        /* View::composer('user.*', function () {
            if (Auth::user()->role == 'user') {
                $keranjang = Keranjang::with(['keranjangDetails.barang'])
                    ->firstWhere('user_id', Auth::id());
                View::share('keranjang', $keranjang);
            }
        }); */
    }
}
