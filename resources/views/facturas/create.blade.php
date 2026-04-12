<!-- resources/views/invoice/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crear Factura</h1>

        <form method="POST" action="{{ route('invoice.store') }}">
            @csrf

            <!-- Campos para la información del cliente -->
            <div class="form-group">
                <label for="client_name">Nombre del Cliente</label>
                <input type="text" class="form-control" id="client_name" name="client_name" required>
            </div>

            <div class="form-group">
                <label for="client_email">Correo Electrónico</label>
                <input type="email" class="form-control" id="client_email" name="client_email" required>
            </div>

            <!-- Sección para agregar los detalles de la factura -->
            <div class="form-group">
                <label>Detalles de la Factura</label>
                <table class="table table-bordered" id="invoice-details">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="details[0][product_name]" required></td>
                            <td><input type="number" class="form-control" name="details[0][quantity]" min="1" value="1" required></td>
                            <td><input type="number" class="form-control" name="details[0][price]" min="0" step="0.01" required></td>
                            <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td><button type="button" class="btn btn-primary add-row">Agregar Fila</button></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <button type="submit" class="btn btn-primary">Crear Factura</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let rowCount = 1;

            // Función para agregar una nueva fila
            function addRow() {
                let row = `
                    <tr>
                        <td><input type="text" class="form-control" name="details[${rowCount}][product_name]" required></td>
                        <td><input type="number" class="form-control" name="details[${rowCount}][quantity]" min="1" value="1" required></td>
                        <td><input type="number" class="form-control" name="details[${rowCount}][price]" min="0" step="0.01" required></td>
                        <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
                    </tr>
                `;
                $('#invoice-details tbody').append(row);
                rowCount++;
            }

            // Función para eliminar una fila
            $(document).on('click', '.remove-row', function() {
                $(this).closest('tr').remove();
            });

            // Evento para agregar una nueva fila
            $('.add-row').click(function() {
                addRow();
            });
        });
    </script>
@endsection