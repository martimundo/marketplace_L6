@extends('layouts.app')
@section('content')
    <h2>Cadastrar Categoria</h2>

    <form action="{{ route('admin.categories.store') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-6 form-group mb-2">
                <label class="form-label">Categoria</label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                    id="exampleFormControlInput1" name="name" value="{{old('name')}}"></input>
                @error('name')
				<div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-3 form-group mb-2">
                <label class="form-label">Descrição</label>
                <input type="description" name="description" value="{{old('description')}}"
                    class="form-control form-control-sm @error('description') is-invalid @enderror"></input>
                @error('description')
				<div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-3 form-group mb-2">
                <label class="form-label">Slug</label>
                <input type="description" name="slug" value="{{old('slug')}}"
                    class="form-control form-control-sm @error('slug') is-invalid @enderror"></input>
                @error('slug')
				<div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>    
        
        <div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{route('admin.categories.index')}}" class="btn btn-info">Lista de categorias</a>
        </div>
    </form>
@endsection
