@extends('layouts.app', ['current'=>'categories'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/categories/{{$category->id}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="categoryName">Nome da categoria</label>
                    <input
                        type="text"
                        class="form-control"
                        name="categoryName"
                        id="categoryName"
                        placeholder="Digite o nome da categoria"
                        value="{{ $category->name }}"
                    >
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a href="/categories" class="btn btn-danger btn-sm">Cancelar</a>
            </form>
        </div>
    </div>
@endsection