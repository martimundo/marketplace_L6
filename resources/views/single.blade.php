@extends('layouts.front')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                @if ($product->photos->count())
                                    <div class="text-center p-4 "> <img id="main-image" src="{{ asset('storage/' . $product->thumb) }}"
                                            width="250" class="thumbimg img-fluid img_principal" />
                                    </div>
                                @else
                                    <div class="text-center p-4"> <img id="main-image" src="{{ asset('assets/img/produtoSemFoto.jpg') }}" width="250" /> </div>
                                @endif
                                @foreach ($product->photos as $photo)
                                <div class="img-fluid" > <img src="{{ asset('storage/' . $photo->image) }}"class=" img-thumbnail thumbnail" width="100" height="100" > </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"> <i class="fa fa-long-arrow-left"></i> <span
                                            class="ml-1"><a href="{{ route('home') }}">Voltar</a></span> </div>
                                            
                                            @if(session()->has('cart'))
                                            <i class="fa fa-shopping-cart text-muted"><span class="badge badge-danger ml-1">{{count(session()->get('cart'))}}</span></i>
                                            @else 
                                            <i class="fa fa-shopping-cart text-muted"><span class="badge badge-danger"></span></i>                                          
                                             @endif
                                </div>
                                <div class="mt-4 mb-3"> <span
                                        class="text-uppercase text-muted brand">{{ $product->name }}</span>
                                    <h5 class="text-uppercase">{{ $product->description }}</h5>
                                    <div class="price d-flex flex-row align-items-center"> <span class="act-price">R$
                                            {{ number_format($product->price, 2, ',', '.') }}</span>
                                        <!-- <div class="ml-2"> <small class="dis-price">$59</small> <span>40% OFF</span>
                                            </div>-->
                                    </div>
                                </div>
                                <!--
                                    <p class="about">Shop from a wide range of t-shirt from orianz. Pefect for your everyday
                                        use, you could pair it with a stylish pair of jeans or trousers complete the look.</p>
                                    <div class="sizes mt-5">
                                        <h6 class="text-uppercase">Size</h6> <label class="radio"> <input type="radio"
                                                name="size" value="S" checked> <span>S</span> </label> <label
                                            class="radio"> <input type="radio" name="size" value="M"> <span>M</span>
                                        </label> <label class="radio"> <input type="radio" name="size" value="L">
                                            <span>L</span> </label> <label class="radio"> <input type="radio" name="size"
                                                value="XL"> <span>XL</span> </label> <label class="radio"> <input
                                                type="radio" name="size" value="XXL"> <span>XXL</span> </label>
                                    </div>
                                    -->
                                <div class="cart mt-4 align-items-center">
                                    <hr>
                                    <form action="{{route('cart.add')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="product[name]" value="{{ $product->name }}">
                                        <input type="hidden" name="product[slug]" value="{{ $product->slug }}">
                                        <input type="hidden" name="product[price]" value="{{ $product->price }}">
                                        <div class="form-group">
                                            <label>Quantidade</label>
                                            <input type="number" class="form-control col-md-4" name="product[amount]"
                                                value="1">
                                        </div>
                                        <button class="btn btn-success text-uppercase mr-2 px-4">Comprar</button>
                                    </form>
                                    <i class="fa fa-heart text-muted"></i> <i class="fa fa-share-alt text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let thumbimg = document.querySelector('img.img_principal');
        let thumbnail =document.querySelectorAll('img.img-thumbnail');

        thumbnail.forEach(function(el){
            el.addEventListener('click', function(){
                thumbimg.src = el.src;               
            });
        });
    </script>
@endsection
