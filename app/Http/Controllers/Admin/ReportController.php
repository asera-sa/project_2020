<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\LicenseRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $total = LicenseRequest::count();
        $active = LicenseRequest::whereNotIn('state', ['rejected', 'completed'])->count();
        $expired = LicenseRequest::where('state', 'rejected')->count();
        $suspended = LicenseRequest::where('state', 'pending_review')->count();

        $latestRequests = LicenseRequest::latest()->get();

        return view('admin.pages.reports.index', compact(
            'total', 'active', 'expired', 'suspended', 'latestRequests'
        ));
    }

    // public function exportPdf()
    // {
    //     $total = LicenseRequest::count();
    //     $active = LicenseRequest::whereNotIn('state', ['rejected', 'completed'])->count();
    //     $expired = LicenseRequest::where('state', 'rejected')->count(); // المرفوضة
    //     $suspended = LicenseRequest::where('state', 'suspended')->count();
    //     $latestRequests = LicenseRequest::latest()->take(5)->get();

    //     $pdf = Pdf::loadView('admin.pages.reports.pdf', compact(
    //         'total', 'active', 'expired', 'suspended', 'latestRequests'
    //     ));

    //     return $pdf->stream('license_report.pdf');
    // }
}
