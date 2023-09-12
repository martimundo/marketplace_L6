@extends('layouts.app')
@section('content')
    @if (!$store)
        <a href="{{ route('admin.stores.create') }}" class="btn btn-secondary mt-2"><i class="fa-solid fa-plus"></i> Cadastrar
            nova
            Loja</a>
    @else
    <div class="container">
        
        <div class="card border-primary mb-3" style="max-width: 18rem;">
            
            <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}"><div class="card-header bg-primary text-white" >Código: {{$store->id }}</div></a>
            
            <div class="card-body">
                <h5 class="card-title">{{ $store->name }}</h5>
                <p class="card-text">{{ $store->description }}.</p>
                <p class="card-text">{{ $store->slug }}.</p>
                <hr class="divider">
                <p class="card-text">Total de Produtos: {{ $store->products->count() }}.</p>
                <hr class="divider">
                <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary">Editar
                    Informações</a>
            </div>
        </div>
        
        <div class="row mb-2">
            <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Remover</button>
            </form>
        </div>
    </div>
    @endif
@endsection
