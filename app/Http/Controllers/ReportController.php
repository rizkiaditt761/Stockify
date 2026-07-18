<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\Report\ReportService;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function index(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        $type = $request->type ?? 'all';

        $data = $this->reportService->getDashboardData(
            $startDate,
            $endDate
        );

        $data['type'] = $type;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        return view(
            'pages.report.index',
            $data
        );
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate   = $request->end_date;
        $type      = $request->type ?? 'all';

        $data = $this->reportService->getDashboardData(
            $startDate,
            $endDate
        );

        $data['type'] = $type;
        $data['startDate'] = $startDate;
        $data['endDate'] = $endDate;

        $pdf = Pdf::loadView(
            'pages.report.pdf',
            $data
        )->setPaper('a4', 'landscape');

        return $pdf->download(
            'Stockify_Report_' .
            now()->format('Ymd_His') .
            '.pdf'
        );
    }
}