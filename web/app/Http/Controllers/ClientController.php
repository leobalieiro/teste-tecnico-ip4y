<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Rules\ValidCpf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(10);
        return view('pages.client_list', compact('clients'));
    }

    public function create()
    {
        return view('pages.client_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cpf' => ['required', 'unique:clients', new ValidCpf],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:clients',
            'gender' => 'required|string',
        ], [
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'first_name.required' => 'O campo Nome é obrigatório.',
            'last_name.required' => 'O campo Sobrenome é obrigatório.',
            'birth_date.required' => 'O campo Data de nascimento é obrigatório.',
            'birth_date.date' => 'O campo Data de nascimento deve ser uma data válida.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este E-mail já está cadastrado.',
            'gender.required' => 'O campo Gênero é obrigatório.',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Client::create($request->all());
        return redirect()->route('clients.index')->with('success', 'Cliente cadastrado com sucesso.');
    }

    public function edit(Client $client)
    {
        return view('pages.client_edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validator = Validator::make($request->all(), [
            'cpf' => ['required', 'unique:clients,cpf,' . $client->id, new ValidCpf],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'gender' => 'required|string',
        ], [
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'first_name.required' => 'O campo Nome é obrigatório.',
            'last_name.required' => 'O campo Sobrenome é obrigatório.',
            'birth_date.required' => 'O campo Data de nascimento é obrigatório.',
            'birth_date.date' => 'O campo Data de nascimento deve ser uma data válida.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'O campo E-mail deve ser um endereço de e-mail válido.',
            'email.unique' => 'Este E-mail já está cadastrado.',
            'gender.required' => 'O campo Gênero é obrigatório.',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $client->update($request->all());
        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente deletado com sucesso.');
    }

    public function send()
    {
        // $clients = Client::all();
        // $response = Http::post('https://api-teste.ip4y.com.br/cadastro', $clients->toJson());

        return redirect()->route('clients.index')->with('success', 'Dados enviado com sucesso.');
    }
}
