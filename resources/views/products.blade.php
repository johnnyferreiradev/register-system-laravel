@extends('layouts.app', ['current'=>'products'])

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title"> Cadastro de produtos </h5>

            <table class="table table-ordered table-hover" id="productsTable">
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

                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <button class="btn btn-sm btn-primary" role="button" onClick="newProduct()">Novo produto</button>
        </div>
    </div>

    <!-- Modal para exibição de formulário de cadastro -->
    <div class="modal" tabindex="-1" role="dialog" id="dlgProducts">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formProduct" action="/products" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Novo produto</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id">

                        <div class="form-group">
                            <label for="productName" class="control-label">Nome do produto</label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="productName"
                                    placeholder="Nome do produto"
                                    name="productName"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productPrice" class="control-label">Preço</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="productPrice"
                                    placeholder="Preço do produto"
                                    name="productPrice"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productStock" class="control-label">Quantidade</label>
                            <div class="input-group">
                                <input
                                    type="number"
                                    class="form-control"
                                    id="productStock"
                                    placeholder="Quantidade em estoque"
                                    name="quantityInStock"
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="productName" class="control-label">Nome do produto</label>
                            <div class="input-group">
                                <select id="category" class="form-control" name="category">
                                    <!-- Os options são adicionados via JS -->
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        // Adiciona o token csrf para todas as requisições realizadas
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{( csrf_token() )}",
            }
        });

        function newProduct() {
            $('#id').val('');
            $('#productName').val('');
            $('#productPrice').val('');
            $('#productStock').val('');
            $('#dlgProducts').modal('show');
        }

        function loadCategories() {
            $.getJSON('/api/categories', function(data) {
                for(let i=0; i<data.length; i++) {
                    option = `<option value='${data[i].id}'>${data[i].name}</option>`
                    $('#category').append(option);
                }
            });
        }

        function loadTeste() { // Show!!!!
            setInterval(() => {
                $.getJSON('/api/teste', function(data) {
                    console.log(data);
                });
            }, 1000);
        }

        function createRow(product) {
            return (
                `<tr>
                    <td>${product.id}</td>
                    <td>${product.name}</td>
                    <td>${product.stock}</td>
                    <td>${product.price}</td>
                    <td>${product.category_id}</td>
                    <td>
                        <button class='btn btn-sm btn-primary' onclick='edit(${product.id})'>Editar</button>
                        <button class='btn btn-sm btn-danger' onclick='remove(${product.id})'>Excluir</button>
                    </td>
                </tr>`
            );
        }

        function loadProducts() {
            $.getJSON('/api/products', function(products) {
                for(let i=0; i<products.length; i++) {
                    line = createRow(products[i]);
                    $('#productsTable > tbody').append(line);
                }
            });
        }

        function createProduct() {
            product = {
                productName: $('#productName').val(),
                productPrice: $('#productPrice').val(),
                quantityInStock: $('#productStock').val(),
                category: $('#category').val(),
            };

            $.post('/api/products', product, function(data) {
                let product = JSON.parse(data);
                let row = createRow(product);
                $('#productsTable > tbody').append(row);
            });
        }

        function edit(id) {
            console.log(`edit - ${id}`);
        }

        function remove(id) {
            $.ajax({
                type: "DELETE",
                url: "http://localhost:8000/api/products/" + id,
                context: this,
            })
            .done(function(msg){
                rows = $('#productsTable > tbody > tr');
                element = rows.filter(function (index, elem) {
                    return elem.cells[0].textContent == id
                });

                if(element) {
                    element.remove();
                }
            })
            .fail(function(jqXHR, textStatus, msg){
                alert(msg);
            });
        }

        $('#formProduct').submit(function(event) {
            event.preventDefault();
            createProduct();
            $('#dlgProducts').modal('hide');
        });

        $(function() {
            loadCategories();
            //loadTeste();
            loadProducts();
        });
    </script>
@endsection
