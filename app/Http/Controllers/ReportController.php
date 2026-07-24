<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Report\ReportService;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(
        ReportService $reportService
    ) {
        $this->reportService = $reportService;
    }

    /*
    |--------------------------------------------------------------------------
    | Report
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $filters = [

            'report'      => $request->report ?? 'stock',

            'type'        => $request->type ?? 'all',

            'category_id' => $request->category_id,

            'start_date'  => $request->start_date,

            'end_date'    => $request->end_date,

            // BARU
            'search'      => $request->search,

        ];

        $data = $this->reportService
            ->getReportData($filters);

        return view(
    'pages.report.index',
    array_merge(
        $data,
        $filters,
        [
            'selectedReport' => $filters['report']
        ]
    )
);
    }

    /*
    |--------------------------------------------------------------------------
    | Export PDF
    |--------------------------------------------------------------------------
    */

    public function exportPdf(Request $request)
    {
        $filters = [

            'report'      => $request->report ?? 'stock',

            'type'        => $request->type ?? 'all',

            'category_id' => $request->category_id,

            'start_date'  => $request->start_date,

            'end_date'    => $request->end_date,

            // BARU
            'search'      => $request->search,

        ];

        $data = $this->reportService
            ->getReportData($filters);

        $pdf = Pdf::loadView(
    'pages.report.pdf',
    array_merge(
        $data,
        $filters,
        [
            'selectedReport' => $filters['report']
        ]
    )
)
        ->setPaper(
            'a4',
            'landscape'
        );

        return $pdf->download(
            'Stockify_Report_' .
            now()->format('Ymd_His') .
            '.pdf'
        );
    }
}