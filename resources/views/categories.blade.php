@extends('layouts.app', ['current'=>'categories'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title"> Cadastro de categorias </h5>
            @if(count($categories) > 0)
                <a href="/categories/new" class="btn btn-sm btn-primary my-3" role="button">Nova categoria</a>
                <table class="table table-ordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a
                                        href="/categories/edit/{{$category->id}}"
                                        class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                    <a
                                        href="/categories/delete/{{$category->id}}"
                                        class="btn btn-sm btn-danger">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h5>Não há categorias cadastradas</h5>
            @endif
        </div>
    </div>
@endsection