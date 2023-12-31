@extends('layouts.app')
@section('content')
    <h2>Cadastrar Produto</h2>

    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">

            <div class="col-6 form-group mb-2">
                <label class="form-label">Nome do Produto<spam class="text-danger">*</spam></label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                    id="exampleFormControlInput1" name="name" value="{{ old('name') }}" autocomplete="name"></input>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-6 form-group mb-2">
                <label class="form-label">Descrição<spam class="text-danger">*</spam></label>
                <input type="text" name="description" value="{{ old('description') }}"
                    class="form-control form-control-sm @error('description') is-invalid @enderror"></input>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control @error('body') is-invalid @enderror" placeholder="Informação do Produto"
                        id="floatingTextarea" style="height: 100px" name="body" value="{{ old('body') }}"></textarea>
                    <label for="floatingTextarea">Informações do Produto<spam class="text-danger">*</spam></label>
                    @error('body')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4 form-group mb-2">
                <label class="form-label">Preço<spam class="text-danger">*</spam></label>
                <input type="text" name="price" id="price"
                    class="form-control form-control-sm @error('price') is-invalid @enderror"></input>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!--
                <div class="col-4 form-group mb-2">
                <label class="form-label">Slug</label>
                <input type="text" name="slug" class="form-control form-control-sm"></input>
                </div>
            -->
            <div class="form-group">
                <label>Categorias</label>
                <select name="categories[]" id="" class="form-control" multiple>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-camera-retro"></i> Foto do Produto</label>
                    <input type="file" name="photos[]"class="form-control @error('photos.*')is-invalid @enderror
                    " multiple>
                    @error('photos')
                        <div class="invalid-feedback">>{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mb-5">
            <button type="submit" class="btn btn-outline-success">Salvar</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn btn-outline-info"><i class="fa-solid fa-rotate-left"></i> Cancelar Cadastro</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">Listagem de Produtos</a>
        </div>
    </form>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js"></script>
    <script>
        $('#price').maskMoney({
            prefix:'',
            allowNegative: false,
            thousands: '.',
            decimal:','
        })
    </script>
@endsection
