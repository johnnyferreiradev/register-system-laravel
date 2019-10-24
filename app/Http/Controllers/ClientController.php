<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newClient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:2|max:20|unique:clients',
            'age' => 'required',
            'address' => 'required|min:5',
            'email' => 'required|email'
        ];

        // Customizando mensagens de erro
        $messages = [
            'name.required' => 'O campo nome é de preenchimento obrigatório',
            'name.min' => 'O nome deve conter no mínimo 2 caracteres',
            'name.max' => 'O nome deve conter no máximo 20 caracteres',
            'name.unique' => 'O nome inserido já está sendo usado',
            'age.required' => 'O campo idade é de preenchimento obrigatório',
            'address.required' => 'O campo endereço é de preenchimento obrigatório',
            'address.min' => 'O endereço deve conter no mínimo 5 caracteres',
            'email.required' => 'O campo email é de preenchimento obrigatório',
            'email.email' => 'O email inserido é invalido'
        ];

        $request->validate($rules, $messages);

        $client = new Client();
        $client->name = $request->input('name');
        $client->age = $request->input('age');
        $client->address = $request->input('address');
        $client->email = $request->input('email');
        $client->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
