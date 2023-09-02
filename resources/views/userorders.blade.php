@extends('layouts.front')
@section('content')
    <div class="col-12">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h4 class="display-4">Meus Pedidos</h4>
                <p class="lead">{{ auth()->user()->name }} aqui você pode visualizar todos os seus pedidos</p>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse ($userOrders as $key => $order)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse{{ $key }}"
                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Pedido nº {{ $order->referece }}
                        </button>
                    </h2>
                    <div id="collapse{{ $key }}"
                        class="accordion-collapse collapse @if ($key == 0) show @endif"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul>
                                @php
                                    $items = unserialize($orders->items);
                                @endphp
                                @foreach ($items as $item)
                                    <li>{{ $item['name'] }} | R$ {{ number_format($item['price'], 2, ',', '.') }}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning" role="alert">
                    Você não tem nenhum pedido ainda!
                </div>
            @endforelse
        </div>
        {{ $userOrders->links() }}
    </div>
@endsection
