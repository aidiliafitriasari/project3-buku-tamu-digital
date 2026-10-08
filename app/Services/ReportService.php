<?php

namespace App\Services;

use App\Models\VisitModel;
use CodeIgniter\Database\BaseBuilder;

class ReportService
{
    protected VisitModel $visitModel;

    public function __construct()
    {
        $this->visitModel = new VisitModel();
    }

    public function parseFilters(array $get): array
    {
        $period     = $get['period'] ?? 'harian';
        $dateFrom   = $get['date_from'] ?? '';
        $dateTo     = $get['date_to'] ?? '';
        $departmentId = (int) ($get['department_id'] ?? 0);
        $employeeId   = (int) ($get['employee_id'] ?? 0);
        $originInstitution = trim((string) ($get['origin_institution'] ?? ''));
        $purposeId  = (int) ($get['visit_purpose_id'] ?? 0);
        $status     = (string) ($get['status'] ?? '');

        $now = new \DateTimeImmutable();
        $today = $now->setTime(0, 0, 0);

        switch ($period) {
            case 'harian':
                $dateFrom = $today->format('Y-m-d');
                $dateTo   = $today->format('Y-m-d');
                break;

            case 'mingguan':
                $dayOfWeek = (int) $today->format('N');
                $weekStart = $today->modify('-' . ($dayOfWeek - 1) . ' days');
                $weekEnd   = $weekStart->modify('+6 days');
                $dateFrom  = $weekStart->format('Y-m-d');
                $dateTo    = $weekEnd->format('Y-m-d');
                break;

            case 'bulanan':
                $monthStart = $today->modify('first day of this month');
                $monthEnd   = $today->modify('last day of this month');
                $dateFrom   = $monthStart->format('Y-m-d');
                $dateTo     = $monthEnd->format('Y-m-d');
                break;

            case 'custom':
            default:
                break;
        }

        return [
            'period'             => $period,
            'date_from'          => $dateFrom,
            'date_to'            => $dateTo,
            'department_id'      => $departmentId,
            'employee_id'        => $employeeId,
            'origin_institution' => $originInstitution,
            'visit_purpose_id'   => $purposeId,
            'status'             => $status,
        ];
    }

    protected function applyFilters($builder, array $filters): void
    {
        $builder->where('visits.deleted_at IS NULL', null, false);

        if (! empty($filters['date_from'])) {
            $builder->where('DATE(visits.arrival_at) >=', $filters['date_from']);
        }

        if (! empty($filters['date_to'])) {
            $builder->where('DATE(visits.arrival_at) <=', $filters['date_to']);
        }

        if (! empty($filters['department_id'])) {
            $builder->where('visits.department_id', $filters['department_id']);
        }

        if (! empty($filters['employee_id'])) {
            $builder->where('visits.employee_id', $filters['employee_id']);
        }

        if (! empty($filters['origin_institution'])) {
            $builder->like('visits.origin_institution', $filters['origin_institution']);
        }

        if (! empty($filters['visit_purpose_id'])) {
            $builder->where('visits.visit_purpose_id', $filters['visit_purpose_id']);
        }

        if (! empty($filters['status'])) {
            $builder->where('visits.status', $filters['status']);
        }
    }

    public function getReportData(array $filters, int $perPage = 50, int $page = 1): array
    {
        $builder = $this->visitModel->builder();

        $builder
            ->select('visits.*, guests.name AS guest_name, guests.phone')
            ->select('departments.name AS department_name')
            ->select('employees.name AS employee_name')
            ->select('visit_purposes.name AS purpose_name')
            ->join('guests', 'guests.id = visits.guest_id', 'left')
            ->join('departments', 'departments.id = visits.department_id', 'left')
            ->join('employees', 'employees.id = visits.employee_id', 'left')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id', 'left');

        $this->applyFilters($builder, $filters);

        $builder->orderBy('visits.arrival_at', 'DESC');
        $builder->orderBy('visits.id', 'DESC');

        $total = $builder->countAllResults(false);

        $pageCount = $total > 0 ? (int) ceil($total / $perPage) : 1;

        if ($page < 1) {
            $page = 1;
        }

        if ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $perPage;

        $items = $builder
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        return [
            'items' => $items,
            'pagination' => [
                'page'       => $page,
                'per_page'   => $perPage,
                'total'      => $total,
                'page_count' => $pageCount,
                'from'       => $total > 0 ? $offset + 1 : 0,
                'to'         => min($offset + $perPage, $total),
            ],
        ];
    }

    public function getSummary(array $filters): array
    {
        $builder = $this->visitModel->builder();
        $builder->where('visits.deleted_at IS NULL', null, false);
        $this->applyFilters($builder, $filters);
        $total = $builder->countAllResults();

        $statuses = ['masih_berkunjung', 'selesai', 'ditolak', 'dibatalkan'];
        $counts = [];

        foreach ($statuses as $status) {
            $b = $this->visitModel->builder();
            $b->where('visits.deleted_at IS NULL', null, false);
            $this->applyFilters($b, $filters);
            $b->where('visits.status', $status);
            $counts[$status] = $b->countAllResults();
        }

        $b = $this->visitModel->builder();
        $b->where('visits.deleted_at IS NULL', null, false);
        $this->applyFilters($b, $filters);
        $b->where('visits.status', 'selesai');
        $b->where('visits.duration IS NOT NULL', null, false);
        $b->selectAvg('visits.duration', 'avg_duration');
        $avg = $b->get()->getRowArray();
        $avgDuration = (int) ($avg['avg_duration'] ?? 0);

        return [
            'total'            => $total,
            'masih_berkunjung' => $counts['masih_berkunjung'],
            'selesai'          => $counts['selesai'],
            'ditolak'          => $counts['ditolak'],
            'dibatalkan'       => $counts['dibatalkan'],
            'avg_duration'     => $avgDuration,
        ];
    }

    public function formatDuration(?int $seconds): string
    {
        if (empty($seconds)) {
            return '-';
        }

        $minutes = floor($seconds / 60);
        $hours   = floor($minutes / 60);
        $days    = floor($hours / 24);

        if ($days > 0) {
            $hours = $hours % 24;
            return $days . 'h ' . $hours . 'j';
        }

        if ($hours > 0) {
            $minutes = $minutes % 60;
            return $hours . 'j ' . $minutes . 'm';
        }

        return $minutes . 'm';
    }
}
