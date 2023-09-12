@extends('layouts.app')
@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mt-2"><i class="fa-solid fa-plus"></i>Nova Categoria</a>

    <div class="container">

        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Criado em: </th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr scope="row">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>
                            <div class="btn-group">

                                <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
                                    class="btn btn-sm btn-primary "> Editar</a>
                                <form
                                    action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}"method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"class="btn btn-sm btn-danger"> <i class="fa-solid fa-trash">
                                            Remover</i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
        {{ $categories->links() }}
    </div>
@endsection
