<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //uma das formas para compartilhar recursos na view.
        $categories = Category::all(['name','slug']);    
        //view()->share('categories', $categories);...compartilhamento de forma singular.

        /**
         * Nessa forma de compartilhamento podemos definir com quais paginas queremos compartilhar recursos.
         */
        // view()->composer('*', function($view) use ($categories){
        //     $view->with('categories',$categories);
        // });
        view()->composer('layouts.front', 'App\Http\Views\CategoryViewComposer@compose');

    }
}
