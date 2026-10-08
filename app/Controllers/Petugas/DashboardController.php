<?php

namespace App\Controllers\Petugas;

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
        $visitSummary = $this->dashboardService->getPetugasVisitSummary();

        $data = [
            'title' => 'Dashboard Petugas',

            // Ringkasan
            'todayVisits'     => $visitSummary['todayVisits'],
            'waitingVisits'   => $visitSummary['waitingVisits'],
            'currentVisits'   => $visitSummary['currentVisits'],
            'completedToday'  => $visitSummary['completedToday'],

            // Statistik
            'todayVisitsByHour' => $this->dashboardService->getTodayVisitsByHour(),
            'statusSummary'     => $this->dashboardService->getStatusSummary(),

            // Daftar kunjungan
            'waitingVisitList' => $this->dashboardService->getWaitingVisits(),
            'currentVisitList' => $this->dashboardService->getCurrentVisits(),
            'longVisits'       => $this->dashboardService->getLongVisits(),

            // Peringatan
            'visitWarning' => $this->dashboardService->getVisitWarning(),
        ];

        return view('petugas/dashboard', $data);
    }
}
