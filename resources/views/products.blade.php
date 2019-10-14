@extends('layouts.app', ['current'=>'products'])

@section('body')
<div class="card border">
        <div class="card-body">
            <h5 class="card-title"> Cadastro de produtos </h5>
                <a href="/products/new" class="btn btn-sm btn-primary my-3" role="button">Novo produto</a>
                @if(count($products) > 0)
                    <table class="table table-ordered table-hover">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->categoryName }}</td>
                                    <td>
                                        <a
                                            href="/products/edit/{{$product->id}}"
                                            class="btn btn-sm btn-primary">
                                            Editar
                                        </a>
                                        <a
                                            href="/products/delete/{{$product->id}}"
                                            class="btn btn-sm btn-danger">
                                            Excluir
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h5><strong>Não há produtos cadastrados</strong></h5>
                @endif
        </div>
    </div>
@endsection