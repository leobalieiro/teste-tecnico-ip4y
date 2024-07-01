@extends('layouts.client')

@section('title', 'Criar Cliente')

@section('content')
    <h1 class="h3 mb-4">Criar Cliente</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" required
                pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um formato de CPF válido 000.000.000-00">
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Nome</label>
            <input type="text" name="first_name" class="form-control" id="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Sobrenome</label>
            <input type="text" name="last_name" class="form-control" id="last_name" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de nascimento</label>
            <input type="date" name="birth_date" class="form-control" id="birth_date" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-select" id="gender" required>
                <option value="" selected disabled>Selecionar gênero</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Enviar</button>
        <button type="reset" class="btn btn-danger">Recomeçar</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary" onclick="loader('show');">Voltar</a>
    </form>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
        });

        $('form').on('submit', function(e) {
            var cpf = $('#cpf').val();
            if (!validCpf(cpf)) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'CPF Inválido',
                    text: 'Por favor digite um CPF válido.',
                });
                return;
            }

            loader('show');
        });
    </script>
@endsection
