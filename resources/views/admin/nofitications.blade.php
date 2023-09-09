@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.notifications.redAll') }}" class="btn btn-success mt-2"> <i class="fa-solid fa-plus"></i>
                Marcar Todas Como Lidas</a>
            <hr>
        </div>
    </div>
    <a href="{{ route('home') }}" class="btn btn-primary mt-2" target="blank">Acessar Loja</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Notificação</th>
                <th scope="col">Criado em</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($unreadNotifications as $n)
                <tr scope="row">
                    <td>{{ $n->data['message'] }}</td>
                    <td>{{ $n->created_at->format('d/m/Y H:i:s') }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.notification.read', ['notification' => $n->id]) }}"
                                class="btn btn-sm btn-outline-info ">Marcar como Lida</a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="alert alert.warnig">
                            <p>Sem novas mensagens</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
