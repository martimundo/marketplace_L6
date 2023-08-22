@extends('layouts.front')

@section('content')
    <div class="row col-12">
        <h2>Carrinho de Compras</h2>
        <hr>
    </div>
    <div class="row col-12">
        @if ($cart)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                        <th scope="col">Preço</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($cart as $car)
                        <tr>
                            <td>{{ $car['name'] }}</td>
                            <td>R$ {{ number_format($car['price'], 2, ',', '.') }}</td>
                            <td>{{ $car['amount'] }}</td>
                            @php
                                $subtotal = $car['price'] * $car['amount'];
                                $total += $subtotal;
                            @endphp
                            <td>R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('cart.remove', ['slug' => $car['slug']]) }}"
                                    class="btn btn-danger btn-sm">remover</a>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="">
                        <td colspan="3">Total:</td>
                        <td colspan="2"> R$ {{ number_format($total, 2, ',', '.') }} </td>
                    </tr>
                </tbody>
            </table>
            <hr>
            <div class="col-md-12 mb-5">
                <a href="{{ route('checkout.index') }}" class="btn btn-lg btn-success float-right">Concluir Compra</a>
                <a href="{{ route('cart.cancel') }}"class="btn btn-lg btn-warning float-left">Cancelar Compra</a>
            </div>
        @else
            <div class="alert alert-warning">Carrinho vazio...</div>
        @endif
    </div>

@endsection
