<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <title>Markteplace</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">Marketplace</a>
			@auth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('/home')) active @endif" aria-current="page" href="#">Home</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link @if(request()->is('admin/store*')) active @endif" href="{{route('admin.stores.index')}}">Minha Loja</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(request()->is('admin/products*')) active @endif" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            Cadastros
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{route('admin.products.index')}}">Produto</a></li>
                           
                            <li><a class="dropdown-item" href="{{route('admin.stores.index')}}">Lojas</a></li>   
                            <li><a class="dropdown-item " href="{{route('admin.categories.index')}}">Categoria</a></li>   
                                                    
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#"><i class="fa-solid fa-truck-fast"></i> Cadastro de Insumos</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fa-sharp fa-solid fa-building"></i> Cadastro de Fabricantes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle @if(request()->is('admin/products*')) active @endif" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="true">
                            Gerenciamento
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Cadastrar Usuário</a></li>
                            
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{route('admin.orders.my')}}">Gerenciar Pedidos</a></li>
                        </ul>
                    </li>
					
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
				<div class="dropdown ">
					<button type="button" class="btn btn-primary dropdown-toggle " data-bs-toggle="dropdown">
                        {{auth()->user()->name}}
					</button>
					<ul class="dropdown-menu">
					  <li><a class="dropdown-item" href="#">Perfil</a></li>
					  <li><a class="dropdown-item" href="{{route('admin.stores.index')}}">Minha Loja</a></li>
					  <li><a class="dropdown-item" onclick="event.preventDefault();document.querySelector('form.logout').submit();" href="#">Sair</a></li>
					  
						<form action="{{route('logout')}}" class="logout" method="post" style="display: none">
							@csrf
						</form>
					  <li><a class="dropdown-item" href="#">Trocar Senha</a></li>
					</ul>
				  </div>
            </div>
			@endauth
        </div>
    </nav>

    <div class="container">

        @include('flash::message')
        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" "></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>

</html>
