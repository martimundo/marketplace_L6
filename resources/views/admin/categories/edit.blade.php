@extends('layouts.app')
@section('content')
	<h2>Editar Categoria</h2>
	<form action="{{route('admin.categories.update',['category'=>$category->id])}}" method="post">	
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		@method("PUT")
		<div class="row">
			<div class="col-6 form-group mb-2">
				<label class="form-label">Nome da Categoria</label>
				<input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" name="name" value="{{$category->name}}"></input>
				@error('name')
					<div class="invalid-feedback">{{$message}}</div>
				@enderror
			</div>

			<div class="col-6 form-group mb-2" >
				<label class="form-label">Descrição</label>
				<input type="description"  class="form-control form-control-sm @error('description') is-invalid @enderror" name="description" value="{{$category->description}}"></input>
				@error('description')
					<div class="invalid-feedback">{{$message}}</div>
				@enderror
			</div>
		</div>	
	<div class="row">
		<div class="col-4 form-group mb-2">
			<label class="form-label">Slug</label>
			<input type="text" class="form-control form-control-sm" name="slug" value="{{$category->slug}}"></input>
		</div>		
	</div>
	<div>
		<button type="submit" class="btn btn-success">Atualizar</button>
		<a href="{{route('admin.categories.index')}}" class="btn btn-primary">Listar</a>
	</div>
</form>
@endsection
