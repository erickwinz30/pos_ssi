<?php

namespace App\Http\Controllers\Reports;

use App\Models\Selling;
use App\Models\Products;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $reports = [];
        $filter = [];

        if (!empty($request->all())) {
            $filter = [
                'startDate' => $request->start_date,
                'endDate' => $request->end_date,
            ];

            $reports = $this->getData($filter);
        }

        return view('reports.product.index', compact('reports', 'filter'));
    }


    public function downloadPdf(Request $request)
    {
        $filter = [
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ];

        $reports = $this->getData($filter);

        $pdf = Pdf::loadView('reports.product.pdf', compact('reports', 'filter'));

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="report_product.pdf"');
    }

    public function getData($filter)
    {
        $startDate = $filter['startDate'] ?? null;
        $endDate = $filter['endDate'] ?? null;

        $filterPeriode = [$startDate, $endDate];

        return Products::with(['sellingDetails'])->select(
            'products.id',
            'products.name',
            'products.code',
            DB::raw('SUM(selling_details.qty) as qty'),
            DB::raw('SUM(selling_details.qty * selling_details.price) as penjualan'),
        )
        ->join('selling_details', 'products.id', '=', 'selling_details.product_id')
        ->join('sellings', 'selling_details.selling_id', '=', 'sellings.id')
        ->when($filterPeriode, function($query) use ($filterPeriode) {
            $query->whereBetween('selling_details.created_at', $filterPeriode);
        })->groupBy('products.id', 'products.name', 'products.code')->orderByDesc('penjualan')->get();
    }
}
