@extends('layouts.front')

@section('content')
    
    <div class="row">
        @foreach ($products as $product)
            <div class="col-3 m-1 ">
                <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                    @if ($product->photos->count())
                        <img src="{{ asset('storage/' . $product->thumb) }}" class="card-img-top"
                            alt="{{ $product->name }}" style="height: 350px; width: 350px;">
                    @else
                        <img src="{{ asset('assets/img/produtoSemFoto.jpg') }}" class="card-img-top" alt="...">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}.</p>
                        <p class="card-text">R$ {{ number_format($product->price, 2, ',', '.') }}.</p>
                        <a href="{{ route('product.single', ['slug' => $product->slug]) }}"
                            class="btn btn-primary">Detalhes</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12 text-center mb-5">
            <h2 ">Lojas em Destaques do Mês</h2>
                    <span>Neste mês, essas são as lojas com maior destaque!</span>
                </div>
                  @foreach ($stores as $store)
                <div class="col-4 ">
                    @if ($store->logo)
                        <img src="{{ asset('storage/' . $store->logo) }}" alt="Logo da Loja{{ $store->name }}"
                            style=""class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/250x250.png?text=logo" alt="Logo sem logo"
                            style=""class="img-fluid">
                    @endif
                    <h3>{{ $store->name }}</h3>
                    <p>{{ $store->description }}</p>
                    <a href="{{ route('store.index', ['slug' => $store->slug]) }}" class="btn btn-sm btn-success">Ver a
                        Loja</a>
                </div>
                @endforeach
        </div>
    @endsection
