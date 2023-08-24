<?php

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
//use Illuminate\Routing\Route;


//######## FRONT END



Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function(){

    Route::get('/', 'CartController@index')->name('index');
    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');    
    Route::post('add', 'CartController@add')->name('add');

});

//Rotas para o CHECKOUT
Route::prefix('checkout')->name('checkout.')->group(function(){

    Route::get('/','CheckoutController@index')->name('index');
    Route::post('/process','CheckoutController@process' )->name('process');


});




//########ROTAS ADMINISTRATIVA
Route::group(['middleware'=>'auth'], function(){

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){

        // Route::prefix('stores')->name('stores.')->group(function(){
    
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store','StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
    
        // });
        Route::resource('stores', 'StoreController');
        Route::resource('categories', 'CategoryController');
        Route::resource('products','ProductController');

        Route::post('photos/remove','ProductPhotoController@removePhoto')->name('photo.remove');
    });
});

Route::get('/model', function(){

    //$user = \App\User::find(42);
    //$user->name = 'Marcos_Editado';
    //$user->email = 'marcos_editado@teste.com.br';
    //$user->password = bcrypt('123456');
    //$user->save();
    //\App\User::paginate(10)
    //\App\User::where('name', 'Marcos')->get()//pega por nome
    //\App\User::where('name', 'Marcos')->first()//pega o primeiro encontrado
    //\App\User::paginate(10) --traz os dados por paginação.

    //Mass assignment - Atributos em Massa
    /*
        Para atribução em massa, no model precisa estar definido os fillable
    */
    /*$user = \App\User::create([
        'name'=>'Adriana',
        'email'=>'adriana@teste.com.br',
        'password'=>bcrypt('1234568')
    ]);*/

   /* $user = \App\User::find(84);

    return  $user->store;

    */

    //Criar uma loja para um usuario
   /* $user = \App\User::find(44);
    $store = $user->store()->create([
        'name'=>'Loja Nova001',
        'description'=>'Descriptio loja 001',
        'fone'=>'12-3456-7890',
        'mobile_fone'=>'12-3456-7890',
        'slug'=>'loja-nova001',
        'user_id'=>44
    ]);

    dd($store);
    */

    //criar um produto para um loja
    /*$loja = \App\Store::find(41);
    $product = $loja->products()->create([
        'name'=>'Produto de Teste',
        'description'=>'Produto de teste',
        'body' => 'esse é um produto de teste',
        'price'=>150.50,
        'slug'=>'produto-de-teste'
    ]);
    dd($product);*/

    //criar uma categoria
    /*\App\Category::create([

         'name'=>'Periféricos',
         'description'=>'',
         'slug'=>'perifericos'
    ]);
      \App\Category::create([

         'name'=>'Casa',
         'description'=>'Tudo para sua casa',
         'slug'=>'casa'
    ]);
        \App\Category::create([

         'name'=>'Automoveis',
         'description'=>'Tudo para seu automovel',
         'slug'=>'automoveis'
    ]);
          \App\Category::create([

         'name'=>'Saúde e Beleza',
         'description'=>'Saúde, beleza e bem estar',
         'slug'=>'saude-e-beleza'
    ]);

    return \App\Category::all();*/



    //adicionar um produto para uma categoria ou vice-versa
    /*$product = \App\Product::find(42);
    $product->categories()->sync([2]);
    dd($product);*/

    $product = \App\Product::find(42);
    return $product->categories;
    
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
