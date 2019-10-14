@extends('layouts.app', ['current'=>'products'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <form action="/products" method="POST">
                @csrf
                <div class="form-group">
                    <label for="productName">Nome do produto</label>
                    <input
                        type="text"
                        class="form-control"
                        name="productName"
                        id="productName"
                        placeholder="Digite o nome do produto"
                    >
                </div>

                <div class="form-group">
                    <label for="quantityInStock">Quantidade em estoque</label>
                    <input
                        type="number"
                        class="form-control"
                        name="quantityInStock"
                        id="quantityInStock"
                        placeholder="Digite a quantidade em estoque"
                    >
                </div>

                <div class="form-group">
                    <label for="productPrice">Preço</label>
                    <input
                        type="number"
                        step="0.01"
                        class="form-control"
                        name="productPrice"
                        id="productPrice"
                        placeholder="Digite o preço do produto"
                    >
                </div>

                <div class="form-group">
                    <label for="productPrice">Categoria</label>
                    <select class="form-control" id="category" name="category">
                        <option value="{{ $categories[0]->id }}">Selecione...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                <a href="/products" class="btn btn-danger btn-sm">Cancelar</a>
            </form>
        </div>
    </div>
@endsection