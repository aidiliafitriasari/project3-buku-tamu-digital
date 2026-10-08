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

        $longVisits = $this->dashboardService->getLongVisits();

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
            'longVisits'   => $longVisits,

            // Peringatan
            'visitWarning' => $this->dashboardService->getVisitWarning(),
        ];

        return view('admin/dashboard', $data);
    }
}
