<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\InvoiceDetail;

class InvoiceController extends Controller
{
    public function create()
    {
        return view('facturas.create');
    }

    public function store(Request $request)
    {
        // Crear una nueva instancia de la factura
        $invoice = new Invoice();
        $invoice->client_name = $request->input('client_name');
        $invoice->client_email = $request->input('client_email');
        // Asignar otros campos de la factura
        $invoice->save();

        // Crear los detalles de la factura
        $details = $request->input('details');
        $total=0;
        for ($i=0; $i < count($details); $i++) { 
            $invoiceDetail = new InvoiceDetail();
            $invoiceDetail->invoice_id = $invoice->id;
            $invoiceDetail->product_name = $details[$i]['product_name'];
            $invoiceDetail->quantity = $details[$i]['quantity'];
            $invoiceDetail->price = $details[$i]['price'];
            $invoiceDetail->save();
            $total=$total+$details[$i]['quantity']*$details[$i]['price'];
            # code...
        }
       $invoice->total=$total;
       $invoice->save();

        // Redirigir o mostrar un mensaje de éxito
        return redirect()->route('invoice.create')->with('success', 'La factura ha sido creada correctamente.');
    }
    
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $details = $invoice->details;

        return view('facturas.show', compact('invoice', 'details'));
    }
}
