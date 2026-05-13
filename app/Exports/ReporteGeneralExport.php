<?php

namespace App\Exports;

use App\Models\Cliente;
use App\Models\GastoExtra;
use App\Models\PagoCamion;
use App\Models\PagoCliente;
use App\Models\PagoProveedor;
use App\Models\Proveedor;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class ReporteGeneralExport implements FromView,ShouldAutoSize, WithStyles,WithColumnWidths,WithEvents
{
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $fechaInicio = $this->request->fecha_inicio ?? now()->startOfMonth()->format('Y-m-d');
        $fechaFin = $this->request->fecha_fin ?? now()->format('Y-m-d');
        $proveedorFiltro = $this->request->filled('proveedor_id') ? Proveedor::find($this->request->proveedor_id)?->nombre : 'TODOS';
        $clienteFiltro = $this->request->filled('cliente_id') ? Cliente::find($this->request->cliente_id)?->nombre : 'TODOS';
        $tipoContratoFiltro = $this->request->filled('tipo_contrato') ? $this->request->tipo_contrato : 'TODOS';
        $pagosProveedor = PagoProveedor::with('contrato.proveedor')->whereNull('deleted_at')->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])->get();
        $cobrosCliente = PagoCliente::with('contrato.cliente')->whereNull('deleted_at')->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])->get();
        $gastosExtras = GastoExtra::with('contrato.proveedor')->whereNull('deleted_at')->whereBetween('fecha', [$fechaInicio, $fechaFin])->get();
        $pagosCamiones = PagoCamion::with(['contrato.proveedor', 'camion'])->whereNull('deleted_at')->whereBetween('fecha_pago', [$fechaInicio, $fechaFin])->get();
        return view('reportes.excel.general', compact('fechaInicio','fechaFin','proveedorFiltro','clienteFiltro','tipoContratoFiltro','pagosProveedor','cobrosCliente','gastosExtras','pagosCamiones'));
    }

    public function styles(Worksheet $sheet)
        {
            return [
                1 => [
                    'font' => ['bold' => true,'size' => 20,'color' => ['rgb' => 'FFFFFF'],],
                    'alignment' => ['horizontal' => 'center','vertical' => 'center',],],
                2 => [
                    'font' => ['italic' => true,'size' => 11,'color' => ['rgb' => '64748B'],],
                    'alignment' => ['horizontal' => 'center','vertical' => 'center',],],
            ];
        }

    public function columnWidths(): array
    {
        return ['A' => 18,'B' => 28,'C' => 38,'D' => 18,'E' => 20,'F' => 18,'G' => 24,];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->freezePane('A8');
                $sheet->getDefaultRowDimension()->setRowHeight(24);
                $sheet->getRowDimension(1)->setRowHeight(34);
                $sheet->getRowDimension(2)->setRowHeight(24);
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->getStyle('A:G')->getAlignment()->setVertical('center')->setWrapText(true);
                $sheet->getStyle('A:G')->getFont()->setName('Segoe UI');
                $sheet->getStyle('A1:G500')->applyFromArray([
                        'borders' => [
                            'allBorders' => ['borderStyle' => 'thin','color' => ['rgb' => 'D1D5DB'],],
                        ],
                    ]);
                $sheet->getStyle('A1:G500')->getAlignment()->setHorizontal('left');
                $sheet->getStyle('A1:G2')->getAlignment()->setHorizontal('center');
                $sheet->getStyle('A1:G1')->getFill()->setFillType('solid')->getStartColor()->setRGB('0F172A');},
        ];
    }
}