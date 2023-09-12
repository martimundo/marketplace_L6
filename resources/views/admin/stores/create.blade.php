@extends('layouts.app')
@section('content')
    <h2>Cadastrar Loja</h2>

    <form action="{{ route('admin.stores.store') }}" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-6 form-group mb-2">
                <label class="form-label">Nome da Loja<spam class="text-danger">*</spam></label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                    id="exampleFormControlInput1" name="name" value=""{{ old('name') }}"></input>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 form-group mb-2">
                <label class="form-label">Descrição<spam class="text-danger">*</spam></label>
                <input type="description" name="description" value="{{ old('description') }}"
                    class="form-control form-control-sm @error('description') is-invalid @enderror"></input>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-6 form-group mb-2">
                <label class="form-label">Telefone<spam class="text-danger">*</spam></label>
                <input type="text" name="fone" id="phonefixed" value="{{ old('fone') }}"
                    class="form-control form-control-sm  @error('fone') is-invalid @enderror"></input>
                @error('fone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-6 form-group mb-2">
                <label class="form-label">Cell Fone</label>
                <input type="text" name="mobile_fone" id="phone" value="{{ old('mobile_fone') }}"
                    class="form-control form-control-sm @error('mobile_fone') is-invalid @enderror"></input>
                @error('mobile_fone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>        
        <div class="row mt-2 mb-2">
            <div class="col-6">
                <div class="form-group">
                    <label for=""><i class="fa-solid fa-camera-retro"></i> Logo</label>
                    <input type="file" name="logo"class="form-control @error('logo')is-invalid @enderror">
                    @error('logo')
                        <div class="invalid-feedback">>{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        let phone = document.getElementById('phone')
        let im = new Inputmask('(99)9-9999-9999');
        im.mask(phone);
        let phonefixed = document.getElementById('phonefixed')
        let imf = new Inputmask('(99)9999-9999');
        imf.mask(phone);
    </script>
@endsection
