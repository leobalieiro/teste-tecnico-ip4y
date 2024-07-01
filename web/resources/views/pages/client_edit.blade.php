@extends('layouts.client')

@section('title', 'Editar Cliente')

@section('content')
    <h1 class="h3 mb-4">Editar Cliente</h1>

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" class="form-control" id="cpf" value="{{ old('cpf', $client->cpf) }}"
                required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" title="Digite um CPF válido no formato 000.000.000-00">
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">Nome</label>
            <input type="text" name="first_name" class="form-control" id="first_name"
                value="{{ old('first_name', $client->first_name) }}" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Sobrenome</label>
            <input type="text" name="last_name" class="form-control" id="last_name"
                value="{{ old('last_name', $client->last_name) }}" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" name="birth_date" class="form-control" id="birth_date"
                value="{{ old('birth_date', $client->birth_date) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" id="email"
                value="{{ old('email', $client->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gênero</label>
            <select name="gender" class="form-select" id="gender" required>
                <option value="" disabled>Selecione o gênero</option>
                <option value="Masculino" {{ old('gender', $client->gender) == 'Masculino' ? 'selected' : '' }}>Masculino
                </option>
                <option value="Feminino" {{ old('gender', $client->gender) == 'Feminino' ? 'selected' : '' }}>Feminino
                </option>
                <option value="Outro" {{ old('gender', $client->gender) == 'Outro' ? 'selected' : '' }}>Outro</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('clients.index') }}" class="btn btn-secondary">Voltar</a>
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
            }
        });
    </script>
@endsection
