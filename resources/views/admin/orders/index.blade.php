@extends('layouts.app')
@section('content')
    <div class="col-12">
        <div class="row">
            <h2>Pedidos</h2>
        </div>
    </div>
    <div class="col-12">
        <div class="accordion" id="accordionExample">
            @forelse ($orders as $key => $order)
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
                                @foreach (filterItemsByStoreId($items, auth()->user()->store_id) as $item)
                                <li>{{$item['name']}} | R$ {{number_format($item['price'], 2,',','.') }}</li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning" role="alert">
                    Nenhum pedido encontrato
                </div>
            @endforelse
        </div>
        {{ $orders->links() }}
    </div>
@endsection
