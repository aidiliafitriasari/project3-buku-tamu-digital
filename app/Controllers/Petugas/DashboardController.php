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

        $longVisits    = $this->dashboardService->getLongVisits();

        if (! empty($longVisits)) {
            try {
                $whatsappService = new \App\Services\WhatsappService();

                foreach ($longVisits as $visit) {
                    $whatsappService->sendWarning((int) $visit['id']);
                }
            } catch (\Throwable $e) {
                log_message('error', '[WA-3] Failed: ' . $e->getMessage());
            }
        }

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
            'longVisits'       => $longVisits,

            // Peringatan
            'visitWarning' => $this->dashboardService->getVisitWarning(),
        ];

        return view('petugas/dashboard', $data);
    }
}
