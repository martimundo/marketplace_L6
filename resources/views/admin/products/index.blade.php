@extends('layouts.app')
@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-secondary mt-2"> <i class="fa-solid fa-plus"></i> Novo
        Produto</a>
    <a href="{{ route('home') }}" class="btn btn-primary mt-2" target="blank">Acessar Loja</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Preço</th>
                <th scope="col">Loja</th>
                <th scope="col">Slug</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr scope="row">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>R$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td>{{$product->store->name}}</td>
                    <td>{{$product->slug}}</td>
                    <td>
                        <div class="btn-group">

                            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}"
                                class="btn btn-sm btn-primary "><i class="fa-solid fa-pencil"> Editar</a></i>
                            <form action="{{ route('admin.products.destroy', ['product' => $product->id]) }}"method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit"class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash"> Remover</i></button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $products->links() }}
@endsection
