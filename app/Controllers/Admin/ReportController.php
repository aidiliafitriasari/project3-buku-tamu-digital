<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;
use App\Models\InstitutionProfileModel;
use App\Services\ReportExportService;
use App\Services\ReportService;

class ReportController extends BaseController
{
    protected ReportService $reportService;
    protected DepartmentModel $departmentModel;
    protected EmployeeModel $employeeModel;
    protected InstitutionProfileModel $institutionModel;
    protected ReportExportService $exportService;
    protected VisitPurposeModel $visitPurposeModel;

    protected array $allowedPerPage = [50, 100, 250, 500];
    protected int $defaultPerPage = 50;

    public function __construct()
    {
        helper('mask');
        $this->reportService     = new ReportService();
        $this->departmentModel   = new DepartmentModel();
        $this->employeeModel     = new EmployeeModel();
        $this->visitPurposeModel = new VisitPurposeModel();
        $this->institutionModel   = new InstitutionProfileModel();
        $this->exportService      = new ReportExportService();
    }

    public function index()
    {
        $filters = $this->reportService->parseFilters($this->request->getGet());

        $perPage = (int) ($this->request->getGet('per_page') ?? $this->defaultPerPage);
        if (! in_array($perPage, $this->allowedPerPage, true)) {
            $perPage = $this->defaultPerPage;
        }

        $page = (int) ($this->request->getGet('page') ?? 1);

        $data = $this->reportService->getReportData($filters, $perPage, $page);
        $summary = $this->reportService->getSummary($filters);

        return view('admin/reports/index', [
            'title'         => 'Laporan Kunjungan',
            'filters'       => $filters,
            'perPage'       => $perPage,
            'items'         => $data['items'],
            'pagination'    => $data['pagination'],
            'summary'       => $summary,
            'departments'   => $this->getDepartments(),
            'employees'     => $this->getEmployees(),
            'purposes'      => $this->getPurposes(),
        ]);
    }

    public function partial()
    {
        $filters = $this->reportService->parseFilters($this->request->getGet());

        $perPage = (int) ($this->request->getGet('per_page') ?? $this->defaultPerPage);
        if (! in_array($perPage, $this->allowedPerPage, true)) {
            $perPage = $this->defaultPerPage;
        }

        $page = (int) ($this->request->getGet('page') ?? 1);

        $data = $this->reportService->getReportData($filters, $perPage, $page);
        $summary = $this->reportService->getSummary($filters);

        $html = view('admin/reports/_table', [
            'items'      => $data['items'],
            'pagination' => $data['pagination'],
            'filters'    => $filters,
            'perPage'    => $perPage,
        ]);

        $summaryHtml = view('admin/reports/_summary', [
            'summary' => $summary,
        ]);

        return $this->response->setJSON([
            'html'        => $html,
            'summaryHtml' => $summaryHtml,
            'pagination'  => $data['pagination'],
            'summary'     => $summary,
        ]);
    }

    public function print()
    {
        $filters = $this->reportService->parseFilters($this->request->getGet());
        $data = $this->reportService->getReportData($filters, 10000, 1);
        $summary = $this->reportService->getSummary($filters);
        $institution = $this->institutionModel->first();

        return view('admin/reports/print', [
            'filters'     => $filters,
            'items'       => $data['items'],
            'summary'     => $summary,
            'institution' => $institution,
            'logoDataUri' => null,
        ]);
    }

    public function export()
    {
        $format  = $this->request->getGet('format');
        $filters = $this->reportService->parseFilters($this->request->getGet());
        $data    = $this->reportService->getReportData($filters, 10000, 1);
        $summary = $this->reportService->getSummary($filters);

        if ($format === 'excel') {
            $this->exportService->generateExcel([
                'items'   => $data['items'],
                'summary' => $summary,
                'filters' => $filters,
            ]);
            return;
        }

        if ($format === 'pdf') {
            $institution = $this->institutionModel->first();

            $logoDataUri = null;
            if (! empty($institution['logo'])) {
                $logoDataUri = $this->exportService->embedImageAsBase64($institution['logo']);
            }

            $html = view('admin/reports/pdf', [
                'filters'     => $filters,
                'items'       => $data['items'],
                'summary'     => $summary,
                'institution' => $institution,
                'logoDataUri' => $logoDataUri,
            ]);

            $this->exportService->generatePdf($html);
            return;
        }

        return redirect()
            ->to('/admin/reports')
            ->with('error', 'Format export tidak dikenal.');
    }

    protected function getDepartments(): array
    {
        return $this->departmentModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    protected function getEmployees(): array
    {
        return $this->employeeModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();
    }

    protected function getPurposes(): array
    {
        return $this->visitPurposeModel
            ->where('is_active', true)
            ->orderBy('name', 'ASC')
            ->findAll();
    }
}
