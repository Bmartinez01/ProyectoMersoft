<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteCreateRequest;
use App\Http\Requests\ClienteEditRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    public function index()
    {
        $clientes = Cliente::paginate(5);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {

        return view('clientes.create');
    }

    public function store(ClienteCreateRequest $request)
    {
      Cliente::create($request->all());
      return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));

    }
    public function update(ClienteEditRequest $request,Cliente $cliente)
    {
        $datos = $request->all();
        $cliente->update($datos);
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');

    }
}

