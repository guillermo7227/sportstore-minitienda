<?php

namespace SportStore\Providers;

use SportStore\Carrito;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!session()->has('carrito')) {
            session()->put('carrito', new Carrito);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        Blade::directive('formatcurrency', function ($money) {
            return "<?php echo '$ ' . number_format($money, 2); ?>";
        });

        Blade::directive('formatdate', function ($date) {
            return "<?php echo date('d-m-Y', strtotime($date)); ?>";
        });

        View::composer('master', function ($view) {
            if (!session()->has('carrito')) {
                session()->put('carrito', new Carrito);
            }
            $carrito = session()->get('carrito');
            $view->with('carrito', $carrito);
        });
    }
}
