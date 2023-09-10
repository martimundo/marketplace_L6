@extends('layouts.app')
@section('content')
    <h2>Editar Produto</h2>

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-6 form-group mb-2">
                <label class="form-label">Nome do Produto</label>
                <input type="text" class="form-control form-control-sm" id="exampleFormControlInput1" name="name"
                    value="{{ $product->name }}"></input>
            </div>
            <div class="col-6 form-group mb-2">
                <label class="form-label">Descrição</label>
                <input type="description" class="form-control form-control-sm" name="description"
                    value="{{ $product->description }}"></input>
            </div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" placeholder="Informação do Produto" id="floatingTextarea" style="height: 100px"
                name="body" value="">{{ $product->body }}</textarea>
            <label for="floatingTextarea">Informações do Produto</label>
        </div>

        <div class="row">
            <div class="col-4 form-group mb-2">
                <label class="form-label">Slug</label>
                <input type="text" class="form-control form-control-sm" name="slug"
                    value="{{ $product->slug }}"></input>
            </div>
            <div class="col-4 form-group mb-2">
                <label class="form-label">Preço</label>
                <input type="text" class="form-control form-control-sm" name="price" id="price"
                    value="{{ $product->price }}"></input>
            </div>
            <div class="col-4 form-group mt-2">
                <label>Categorias</label>
                <select name="categories[]" class="form-select" multiple aria-label="multiple ">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($product->categories->contains($category)) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-camera-retro"></i> Foto do Produto</label>
                    <input type="file" name="photos[]" class="form-control @error('photos.*')is-invalid @enderror" 
                        multiple>
                    @error('photos')
                        <div class="invalid-feedback">>{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="mb-4">
            <button type="submit" class="btn btn-outline-success">Salvar</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn btn-outline-info"><i class="fa-solid fa-rotate-left"></i> Cancelar Atualização</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">Listagem de Produtos</a>
        </div>
    </form>
    <div class="row">
        @foreach ($product->photos as $photo)
            <div class="col-4 m-4">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="" class="img-fluid rounded">

                <form action="{{ route('admin.photo.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="photoName" value="{{ $photo->image }}">
                    <button type="submit" class="btn btn-outline-danger "><i class="fa-regular fa-trash-can"></i></button>
                </form>
            </div>
        @endforeach
    </div>
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
