@extends('layouts.client')

@section('title', 'Lista de clientes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Clientes</h1>
        <a href="{{ route('clients.create') }}" class="btn btn-primary">Criar novo cliente</a>
    </div>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Data de nascimento</th>
                <th>E-mail</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
                <tr>
                    <td data-mask="000.000.000-00">{{ $client->cpf }}</td>
                    <td>{{ $client->first_name }}</td>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ date('d/m/Y', strtotime($client->birth_date)) }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->gender }}</td>
                    <td>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="if(!confirm('Realmente deseja deletar esse cliente?')) return false;">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clients->links('components.client_pagination') }}


    <form action="{{ route('clients.send') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Enviar dados para API</button>
    </form>
@endsection
