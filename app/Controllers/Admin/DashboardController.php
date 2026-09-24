<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\DashboardService;

class DashboardController extends BaseController
{
    protected DashboardService $dashboardService;

    public function __construct()
    {
        $this->dashboardService = new DashboardService();
    }

    public function index()
    {
        $visitSummary = $this->dashboardService->getVisitSummary();
        $masterSummary = $this->dashboardService->getMasterSummary();

        $data = [
            'title' => 'Dashboard Admin',

            // Ringkasan Kunjungan
            ...$visitSummary,

            // Ringkasan Master Data
            ...$masterSummary,

            // Statistik
            'visitsByDepartment' => $this->dashboardService->getVisitsByDepartment(),
            'dailyVisits'        => $this->dashboardService->getDailyVisits(),
            'visitsByHour'       => $this->dashboardService->getVisitsByHour(),

            // Monitoring
            'latestVisits' => $this->dashboardService->getLatestVisits(),
            'longVisits'   => $this->dashboardService->getLongVisits(),
        ];

        return view('admin/dashboard', $data);
    }
}
