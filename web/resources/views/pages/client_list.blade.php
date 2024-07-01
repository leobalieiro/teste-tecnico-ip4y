@extends('layouts.client')

@section('title', 'Lista de clientes')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Clientes</h1>

        <div class="d-flex gap-2">
            <form action="{{ route('clients.send') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success" onclick="loader('show');">Enviar dados para API</button>
            </form>

            <a href="{{ route('clients.create') }}" class="btn btn-primary" onclick="loader('show');">Criar novo cliente</a>
        </div>
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
                        <a href="{{ route('clients.edit', $client->id) }}"
                            class="btn-edit btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete btn btn-danger btn-sm ">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div id="pagination">
        {{ $clients->links('components.client_pagination') }}
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-edit').click(function() {
                loader('show');
            });

            $('.btn-delete').click(function(e) {
                e.preventDefault(); // Prevê a ação padrão do formulário
                const form = $(this).closest('form');
                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter esta ação!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar cliente!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        loader('show');
                        form.submit();
                    }
                })
            });

            $('#pagination .page-link').click(function() {
                loader('show');
            });
        });
    </script>
@endsection
