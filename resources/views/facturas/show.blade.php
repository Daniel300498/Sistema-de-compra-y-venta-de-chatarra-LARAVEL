<!-- resources/views/invoice/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles de la Factura</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Información del Cliente</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Nombre:</strong> {{ $invoice->client_name }}</p>
                        <p><strong>Correo Electrónico:</strong> {{ $invoice->client_email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Resumen de la Factura</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Total:</strong> {{ $invoice->total }}</p>
                        <!-- Puedes agregar más campos relevantes aquí -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detalles de la Factura</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product_name }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->price }}</td>
                                        <td>{{ $detail->quantity * $detail->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection