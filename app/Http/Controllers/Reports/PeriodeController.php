<?php

namespace App\Http\Controllers\Reports;

use App\Models\Selling;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PeriodeController extends Controller
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

        return view('reports.period.index', compact('reports', 'filter'));
    }


    public function downloadPdf(Request $request)
    {
        $filter = [
            'startDate' => $request->start_date,
            'endDate' => $request->end_date,
        ];

        $reports = $this->getData($filter);

        $pdf = Pdf::loadView('reports.period.pdf', compact('reports', 'filter'));

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="report_period.pdf"');
    }

    public function getData($filter)
    {
        $startDate = $filter['startDate'] ?? null;
        $endDate = $filter['endDate'] ?? null;

        $filterPeriode = [$startDate, $endDate];

        return Selling::when($filterPeriode, function ($query) use ($filterPeriode) {
                    $query->whereBetween(DB::raw('DATE(created_at)'), $filterPeriode)
                        ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total_sales'))
                        ->groupBy(DB::raw('DATE(created_at)'));
                })->orderBy('date', 'ASC')
                ->get();
    }
}
