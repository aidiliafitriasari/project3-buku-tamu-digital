<?php

namespace App\Services;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\GuestModel;
use App\Models\SettingModel;
use App\Models\UserModel;
use App\Models\VisitModel;
use App\Models\VisitPurposeModel;

class DashboardService
{
    protected VisitModel $visitModel;
    protected UserModel $userModel;
    protected EmployeeModel $employeeModel;
    protected DepartmentModel $departmentModel;
    protected VisitPurposeModel $visitPurposeModel;
    protected SettingModel $settingModel;
    protected GuestModel $guestModel;

    public function __construct()
    {
        $this->visitModel        = new VisitModel();
        $this->userModel         = new UserModel();
        $this->employeeModel     = new EmployeeModel();
        $this->departmentModel   = new DepartmentModel();
        $this->visitPurposeModel = new VisitPurposeModel();
        $this->settingModel      = new SettingModel();
        $this->guestModel        = new GuestModel();
    }

    public function getVisitSummary(): array
    {
        $now = new \DateTimeImmutable();

        $todayStart = $now->setTime(0, 0, 0);
        $tomorrowStart = $todayStart->modify('+1 day');

        $dayOfWeek = (int) $todayStart->format('N');

        $weekStart = $todayStart->modify('-' . ($dayOfWeek - 1) . ' days');
        $nextWeekStart = $weekStart->modify('+7 days');

        $monthStart = $todayStart->modify('first day of this month');
        $nextMonthStart = $monthStart->modify('first day of next month');

        $visitStatuses = [
            'masih_berkunjung',
            'selesai',
        ];

        $todayVisits = $this->visitModel
            ->where('arrival_at >=', $todayStart->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $tomorrowStart->format('Y-m-d H:i:s'))
            ->whereIn('status', $visitStatuses)
            ->countAllResults();

        $weekVisits = $this->visitModel
            ->where('arrival_at >=', $weekStart->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $nextWeekStart->format('Y-m-d H:i:s'))
            ->whereIn('status', $visitStatuses)
            ->countAllResults();

        $monthVisits = $this->visitModel
            ->where('arrival_at >=', $monthStart->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $nextMonthStart->format('Y-m-d H:i:s'))
            ->whereIn('status', $visitStatuses)
            ->countAllResults();

        $currentVisits = $this->visitModel
            ->where('status', 'masih_berkunjung')
            ->countAllResults();

        $completedVisits = $this->visitModel
            ->where('status', 'selesai')
            ->countAllResults();

        return [
            'todayVisits'     => $todayVisits,
            'weekVisits'      => $weekVisits,
            'monthVisits'     => $monthVisits,
            'currentVisits'   => $currentVisits,
            'completedVisits' => $completedVisits,
        ];
    }

    // Dashboard Petugas
    public function getPetugasVisitSummary(): array
    {
        $now = new \DateTimeImmutable();

        $todayStart = $now->setTime(0, 0, 0);
        $tomorrowStart = $todayStart->modify('+1 day');

        $actualVisitStatuses = [
            'masih_berkunjung',
            'selesai',
        ];

        $todayVisits = $this->visitModel
            ->where('arrival_at >=', $todayStart->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $tomorrowStart->format('Y-m-d H:i:s'))
            ->whereIn('status', $actualVisitStatuses)
            ->countAllResults();

        $waitingVisits = $this->visitModel
            ->where('status', 'menunggu')
            ->countAllResults();

        $currentVisits = $this->visitModel
            ->where('status', 'masih_berkunjung')
            ->countAllResults();

        $completedToday = $this->visitModel
            ->where('status', 'selesai')
            ->where('checkout_at >=', $todayStart->format('Y-m-d H:i:s'))
            ->where('checkout_at <', $tomorrowStart->format('Y-m-d H:i:s'))
            ->countAllResults();

        return [
            'todayVisits'    => $todayVisits,
            'waitingVisits'  => $waitingVisits,
            'currentVisits'  => $currentVisits,
            'completedToday' => $completedToday,
        ];
    }

    public function getTodayVisitsByHour(): array
    {
        $now = new \DateTimeImmutable();

        $todayStart = $now->setTime(0, 0, 0);
        $tomorrowStart = $todayStart->modify('+1 day');

        $rows = $this->visitModel
            ->select('HOUR(arrival_at) AS visit_hour, COUNT(id) AS total')
            ->where('arrival_at >=', $todayStart->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $tomorrowStart->format('Y-m-d H:i:s'))
            ->whereIn('status', ['masih_berkunjung', 'selesai'])
            ->groupBy('HOUR(arrival_at)')
            ->orderBy('visit_hour', 'ASC')
            ->findAll();

        $result = [];

        foreach ($rows as $row) {
            $result[(int) $row['visit_hour']] = (int) $row['total'];
        }

        $todayVisitsByHour = [];

        for ($hour = 0; $hour < 24; $hour++) {
            $todayVisitsByHour[] = [
                'hour'  => sprintf('%02d:00', $hour),
                'total' => $result[$hour] ?? 0,
            ];
        }

        return $todayVisitsByHour;
    }

    public function getStatusSummary(): array
    {
        $statuses = [
            'menunggu',
            'ditolak',
            'dibatalkan',
            'masih_berkunjung',
            'selesai',
        ];

        $statusSummary = [];

        foreach ($statuses as $status) {
            $statusSummary[$status] = $this->visitModel
                ->where('status', $status)
                ->countAllResults();
        }

        return $statusSummary;
    }

    public function getWaitingVisits(): array
    {
        return $this->visitModel
            ->select([
                'visits.id',
                'visits.visit_code',
                'visits.status',
                'visits.arrival_at',
                'visits.origin_institution',
                'guests.name AS guest_name',
                'departments.name AS department_name',
                'employees.name AS employee_name',
                'visit_purposes.name AS purpose_name',
            ])
            ->join('guests', 'guests.id = visits.guest_id')
            ->join('departments', 'departments.id = visits.department_id')
            ->join('employees', 'employees.id = visits.employee_id')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id')
            ->where('visits.status', 'menunggu')
            ->orderBy('visits.arrival_at', 'ASC')
            ->findAll(5);
    }

    public function getCurrentVisits(): array
    {
        return $this->visitModel
            ->select([
                'visits.id',
                'visits.visit_code',
                'visits.status',
                'visits.arrival_at',
                'visits.checkin_at',
                'visits.origin_institution',
                'guests.name AS guest_name',
                'departments.name AS department_name',
                'employees.name AS employee_name',
                'visit_purposes.name AS purpose_name',
            ])
            ->join('guests', 'guests.id = visits.guest_id')
            ->join('departments', 'departments.id = visits.department_id')
            ->join('employees', 'employees.id = visits.employee_id')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id')
            ->where('visits.status', 'masih_berkunjung')
            ->where('visits.checkin_at IS NOT NULL', null, false)
            ->orderBy('visits.checkin_at', 'ASC')
            ->findAll(5);
    }

    public function getMasterSummary(): array
    {
        $totalUsers = $this->userModel
            ->countAllResults();

        $totalEmployees = $this->employeeModel
            ->countAllResults();

        $totalDepartments = $this->departmentModel
            ->countAllResults();

        $totalPurposes = $this->visitPurposeModel
            ->countAllResults();

        return [
            'totalUsers'       => $totalUsers,
            'totalEmployees'   => $totalEmployees,
            'totalDepartments' => $totalDepartments,
            'totalPurposes'    => $totalPurposes,
        ];
    }

    public function getVisitsByDepartment(): array
    {
        return $this->visitModel
            ->select('departments.name AS department_name, COUNT(visits.id) AS total')
            ->join('departments', 'departments.id = visits.department_id')
            ->whereIn('visits.status', ['masih_berkunjung', 'selesai'])
            ->groupBy('visits.department_id')
            ->orderBy('total', 'DESC')
            ->findAll();
    }

    public function getDailyVisits(): array
    {
        $now = new \DateTimeImmutable();

        $todayStart = $now->setTime(0, 0, 0);
        $startDate  = $todayStart->modify('-6 days');
        $endDate    = $todayStart->modify('+1 day');

        $rows = $this->visitModel
            ->select('DATE(arrival_at) AS visit_date, COUNT(id) AS total')
            ->where('arrival_at >=', $startDate->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $endDate->format('Y-m-d H:i:s'))
            ->whereIn('status', ['masih_berkunjung', 'selesai'])
            ->groupBy('DATE(arrival_at)')
            ->orderBy('visit_date', 'ASC')
            ->findAll();

        $result = [];

        foreach ($rows as $row) {
            $result[$row['visit_date']] = (int) $row['total'];
        }

        $dailyVisits = [];

        for ($date = $startDate; $date < $endDate; $date = $date->modify('+1 day')) {
            $dateKey = $date->format('Y-m-d');

            $dailyVisits[] = [
                'date'  => $dateKey,
                'total' => $result[$dateKey] ?? 0,
            ];
        }

        return $dailyVisits;
    }

    public function getVisitsByHour(): array
    {
        $now = new \DateTimeImmutable();

        $todayStart = $now->setTime(0, 0, 0);
        $startDate  = $todayStart->modify('-6 days');
        $endDate    = $todayStart->modify('+1 day');

        $rows = $this->visitModel
            ->select('HOUR(arrival_at) AS visit_hour, COUNT(id) AS total')
            ->where('arrival_at >=', $startDate->format('Y-m-d H:i:s'))
            ->where('arrival_at <', $endDate->format('Y-m-d H:i:s'))
            ->whereIn('status', ['masih_berkunjung', 'selesai'])
            ->groupBy('HOUR(arrival_at)')
            ->orderBy('visit_hour', 'ASC')
            ->findAll();

        $result = [];

        foreach ($rows as $row) {
            $result[(int) $row['visit_hour']] = (int) $row['total'];
        }

        $visitsByHour = [];

        for ($hour = 0; $hour < 24; $hour++) {
            $visitsByHour[] = [
                'hour'  => sprintf('%02d:00', $hour),
                'total' => $result[$hour] ?? 0,
            ];
        }

        return $visitsByHour;
    }

    public function getLatestVisits(): array
    {
        return $this->visitModel
            ->select([
                'visits.id',
                'visits.visit_code',
                'visits.status',
                'visits.arrival_at',
                'guests.name AS guest_name',
                'departments.name AS department_name',
                'employees.name AS employee_name',
                'visit_purposes.name AS purpose_name',
            ])
            ->join('guests', 'guests.id = visits.guest_id')
            ->join('departments', 'departments.id = visits.department_id')
            ->join('employees', 'employees.id = visits.employee_id')
            ->join('visit_purposes', 'visit_purposes.id = visits.visit_purpose_id')
            ->orderBy('visits.arrival_at', 'DESC')
            ->findAll(5);
    }

    public function getLongVisits(): array
    {
        $setting = $this->settingModel->first();

        if (! $setting || empty($setting['visit_warning'])) {
            return [];
        }

        $warningMinutes = (int) $setting['visit_warning'];

        $cutoffTime = (new \DateTimeImmutable())
            ->modify("-{$warningMinutes} minutes");

        $now = new \DateTimeImmutable();

        $visits = $this->visitModel
            ->select([
                'visits.id',
                'visits.visit_code',
                'visits.checkin_at',
                'visits.status',
                'guests.name AS guest_name',
                'departments.name AS department_name',
                'employees.name AS employee_name',
            ])
            ->join('guests', 'guests.id = visits.guest_id')
            ->join('departments', 'departments.id = visits.department_id')
            ->join('employees', 'employees.id = visits.employee_id')
            ->where('visits.status', 'masih_berkunjung')
            ->where('visits.checkin_at IS NOT NULL', null, false)
            ->where('visits.checkin_at <', $cutoffTime->format('Y-m-d H:i:s'))
            ->orderBy('visits.checkin_at', 'ASC')
            ->findAll();

        foreach ($visits as &$visit) {
            $durationMinutes = 0;

            if (! empty($visit['checkin_at'])) {
                $checkinTimestamp = strtotime($visit['checkin_at']);

                if ($checkinTimestamp !== false) {
                    $durationMinutes = max(
                        0,
                        (int) floor(($now->getTimestamp() - $checkinTimestamp) / 60)
                    );
                }
            }

            $visit['duration_minutes'] = $durationMinutes;
        }

        unset($visit);

        return $visits;
    }
}
