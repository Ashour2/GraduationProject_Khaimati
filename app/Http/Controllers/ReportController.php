<?php

namespace App\Http\Controllers;

use App\Models\Camp;
use Barryvdh\DomPDF\Facade\Pdf;
use Mpdf\Mpdf;

class ReportController extends Controller
{
    use Traits\DashboardData;

    public function index()
    {
        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'reports',
                'camps' => Camp::with('representative')->get(),
            ]
        ));
    }

    public function general()
    {
        $camps = Camp::with('representative')->get();

        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'reports',
                'subsection' => 'general-report',
                'reportCamps' => $camps,
            ]
        ));
    }

    public function camp(Camp $camp)
    {
        $camp->load('representative');

        return view('dashboard.dashboard', array_merge(
            $this->dashboardData(),
            [
                'section' => 'reports',
                'subsection' => 'camp-report',
                'reportCamp' => $camp,
            ]
        ));
    }

    public function downloadGeneral()
    {
        $camps = Camp::with('representative')->get();

        $html = view('reports.general-pdf', [
            'camps' => $camps,
        ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'directionality' => 'rtl',
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('general-camps-report.pdf', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="general-camps-report.pdf"');
    }

    public function downloadCamp(Camp $camp)
    {
        $camp->load('representative');

        $html = view('reports.camp-pdf', [
            'camp' => $camp,
        ])->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'default_font' => 'dejavusans',
            'directionality' => 'rtl',
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('camp-report-' . $camp->id . '.pdf', 'S'))
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="camp-report-' . $camp->id . '.pdf"');
    }
}
