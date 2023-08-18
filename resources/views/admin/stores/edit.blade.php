@extends('layouts.app')
@section('content')
    <h2>Editar Dados da Loja</h2>
    <form action="{{ route('admin.stores.update', ['store' => $store->id]) }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @method('PUT')
        <div class="row">
            <div class="col-6 form-group mb-2">
                <label class="form-label">Nome da Loja</label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name"
                    value="{{ $store->name }}"></input>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6 form-group mb-2">
                <label class="form-label">Descrição</label>
                <input type="description" class="form-control form-control-sm @error('description') is-invalid @enderror"
                    name="description" value="{{ $store->description }}"></input>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group mb-2">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control form-control-sm" @error('fone') is-invalid @enderror
                    name="fone" value="{{ $store->fone }}"></input>
                @error('fone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 form-group mb-2">
                <label class="form-label">Cell Fone</label>
                <input type="text" class="form-control form-control-sm @error('mobile-fone') is-invalid @enderror"
                    name="mobile_fone" value="{{ $store->mobile_fone }}"></input>
                @error('mobile-fone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-4 form-group mb-2">
                <label class="form-label">Slug</label>
                <input type="text" class="form-control form-control-sm" name="slug"
                    value="{{ $store->slug }}"></input>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="row">
                <div class="col-4 m-4">
                    <img src="{{ asset('storage/' . $store->logo) }}" alt="" class="img-fluid rounded"
                        style="width: 100px; heigth:100px">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-camera-retro"></i> Logo</label>
                    <input type="file" name="logo"class="form-control @error('logo') is-invalid @enderror">
                    @error('logo')
                        <div class="invalid-feedback">>{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>
        <div>
            <button type="submit" class="btn btn-success">Atualizar</button>
            <a href="{{ route('admin.stores.index') }}" class="btn btn-primary">Listar</a>
        </div>
    </form>
@endsection
