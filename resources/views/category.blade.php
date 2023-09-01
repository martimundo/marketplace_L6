@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">{{ $category->name }}</div>
        <hr class="bg-primary mb-5">
        @forelse ($category->products as $product)
                <div class="col-3 m-1 ">
                    <div class="card shadow p-3 mb-5 bg-body rounded" style="width: 18rem;">
                        @if ($product->photos->count())
                            <img src="{{ asset('storage/' . $product->photos->first()->image) }}" class="card-img-top"
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
           
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Não Há Produtos para essa categoria</h3>
            </div>
        @endforelse
    </div>
@endsection
