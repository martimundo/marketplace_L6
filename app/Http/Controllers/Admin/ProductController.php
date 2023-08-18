<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\Store;
use App\Traits\UploadTrait;



class ProductController extends Controller
{
    use UploadTrait;
    
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userStore = auth()->user()->store;

        $products = $userStore->products()->paginate(10);

        //$products->photos->first();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->all(); //faz a req. de todos os dados 

        $store = auth()->user()->store; //pega a loja do usuário da logado

        $product = $store->products()->create($data); //cria um novo produto na loja do usuário

        $product->categories()->sync($data['categories']); //faz o insert da categoria no produto

        if($request->hasFile('photos')){

            $images = $this->imageUpload($request->file('photos'),'image');

            //inserção das fotos na table
            $product->photos()->createMany($images);
        }

        flash("Produto cadastrado com sucesso")->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = $this->product->find($id);

        $categories = Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $product = $this->product->find($id);

        $product->update($data);

        $product->categories()->sync($data['categories']); //faz o insert da categoria no produto

        if($request->hasFile('photos')){

            $images = $this->imageUpload($request->file('photos'),'image');

            //inserção das fotos na table
            $product->photos()->createMany($images);
        }

        flash("Produto atualizado com sucesso")->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $product = $this->product->find($id);

        $product->delete();

        flash("Produto Removido com sucesso")->success();

        return redirect()->route('admin.products.index');
    }
   
}