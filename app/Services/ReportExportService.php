<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Cell\DataType;

class ReportExportService
{
    protected array $statusColors = [
        'menunggu'         => 'FEF3C7',
        'masih_berkunjung' => 'DBEAFE',
        'selesai'          => 'D1FAE5',
        'ditolak'          => 'FEE2E2',
        'dibatalkan'       => 'E5E7EB',
    ];

    // PDF
    public function generatePdf(string $html, string $filename = 'laporan-kunjungan'): void
    {
        $options = new Options();
        $options->set('isRemoteEnabled', false);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('chroot', FCPATH);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $canvas = $dompdf->getCanvas();
        $canvas->page_text(
            500,
            570,
            "Halaman {PAGE_NUM} dari {PAGE_COUNT}",
            null,
            8,
            [0.4, 0.4, 0.4]
        );

        $dompdf->stream($filename . '.pdf', ['Attachment' => true]);
        exit;
    }

    public function embedImageAsBase64(string $relativePath): string
    {
        $fullPath = FCPATH . ltrim($relativePath, '/');

        if (! file_exists($fullPath)) {
            return '';
        }

        $mime = mime_content_type($fullPath);
        $data = base64_encode(file_get_contents($fullPath));

        return "data:{$mime};base64,{$data}";
    }

    // EXCEL
    public function generateExcel(array $data): void
    {
        $items   = $data['items'] ?? [];
        $summary = $data['summary'] ?? [];
        $filters = $data['filters'] ?? [];

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()
            ->setCreator('Buku Tamu Digital')
            ->setTitle('Laporan Kunjungan')
            ->setSubject('Laporan Kunjungan');

        $this->buildSummarySheet($spreadsheet, $summary, $filters);
        $this->buildDetailSheet($spreadsheet, $items);

        $this->outputExcel($spreadsheet);
    }

    protected function buildSummarySheet(Spreadsheet $spreadsheet, array $summary, array $filters): void
    {
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Ringkasan');

        // Judul
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', 'LAPORAN KUNJUNGAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getFont()->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF00309F');
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Periode
        $sheet->setCellValue('A3', 'Periode');
        $sheet->setCellValue('B3', $this->formatPeriod($filters));
        $sheet->getStyle('A3')->getFont()->setBold(true);

        // Filter Aktif
        $row = 5;
        $sheet->setCellValue('A' . $row, 'FILTER AKTIF');
        $sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(11);
        $row++;

        foreach ($this->getFilterLabels($filters) as $label => $value) {
            $sheet->setCellValue('A' . $row, $label);
            $sheet->setCellValue('B' . $row, $value);
            $sheet->getStyle('A' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF3F4F6');
            $sheet->getStyle('A' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $row++;
        }

        $row++;

        // Ringkasan
        $sheet->setCellValue('A' . $row, 'RINGKASAN');
        $sheet->getStyle('A' . $row)->getFont()->setBold(true)->setSize(11);
        $row++;

        $summaryRows = [
            'Total Kunjungan'  => $summary['total'] ?? 0,
            'Selesai'          => $summary['selesai'] ?? 0,
            'Masih Berkunjung' => $summary['masih_berkunjung'] ?? 0,
            'Ditolak'          => $summary['ditolak'] ?? 0,
            'Dibatalkan'       => $summary['dibatalkan'] ?? 0,
            'Rata-rata Durasi' => $this->formatDuration((int) ($summary['avg_duration'] ?? 0)),
        ];

        foreach ($summaryRows as $label => $value) {
            $sheet->setCellValue('A' . $row, $label);
            $sheet->setCellValue('B' . $row, $value);
            $sheet->getStyle('A' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFF3F4F6');
            $sheet->getStyle('A' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('B' . $row)->getFont()->setBold(true);
            $row++;
        }

        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(35);
    }

    protected function buildDetailSheet(Spreadsheet $spreadsheet, array $items): void
    {
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle('Detail');

        $headers = [
            'No',
            'Kode',
            'Nama Tamu',
            'No. HP',
            'Asal Instansi',
            'Departemen',
            'Pegawai',
            'Keperluan',
            'Datang',
            'Check-in',
            'Check-out',
            'Durasi',
            'Status',
        ];

        $col = 'A';
        foreach ($headers as $h) {
            $sheet->setCellValue($col . '1', $h);
            $col++;
        }

        $lastCol = 'M';
        $headerRange = 'A1:' . $lastCol . '1';

        $sheet->getStyle($headerRange)->getFont()->setBold(true)->getColor()->setARGB('FFFFFFFF');
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FF1F2937');
        $sheet->getStyle($headerRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle($headerRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getRowDimension(1)->setRowHeight(25);

        $sheet->freezePane('A2');

        $row = 2;
        foreach ($items as $i => $item) {
            $sheet->setCellValue('A' . $row, $i + 1);
            $sheet->setCellValue('B' . $row, $item['visit_code'] ?? '-');
            $sheet->setCellValue('C' . $row, $item['guest_name'] ?? '-');
            $sheet->setCellValueExplicit('D' . $row, (string) ($item['phone'] ?? '-'), DataType::TYPE_STRING);
            $sheet->setCellValue('E' . $row, $item['origin_institution'] ?? '-');
            $sheet->setCellValue('F' . $row, $item['department_name'] ?? '-');
            $sheet->setCellValue('G' . $row, $item['employee_name'] ?? '-');
            $sheet->setCellValue('H' . $row, $item['purpose_name'] ?? '-');
            $sheet->setCellValue('I' . $row, ! empty($item['arrival_at']) ? date('d/m/Y H:i', strtotime($item['arrival_at'])) : '-');
            $sheet->setCellValue('J' . $row, ! empty($item['checkin_at']) ? date('d/m/Y H:i', strtotime($item['checkin_at'])) : '-');
            $sheet->setCellValue('K' . $row, ! empty($item['checkout_at']) ? date('d/m/Y H:i', strtotime($item['checkout_at'])) : '-');
            $sheet->setCellValue('L' . $row, $this->formatDuration((int) ($item['duration'] ?? 0)));

            $status = $item['status'] ?? '-';
            $sheet->setCellValue('M' . $row, ucwords(str_replace('_', ' ', $status)));

            if (isset($this->statusColors[$status])) {
                $sheet->getStyle('M' . $row)->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FF' . $this->statusColors[$status]);
            }

            $row++;
        }

        if ($row > 2) {
            $bodyRange = 'A2:' . $lastCol . ($row - 1);
            $sheet->getStyle($bodyRange)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle($bodyRange)->getAlignment()->setVertical(Alignment::VERTICAL_TOP);
        }

        $sheet->setAutoFilter('A1:' . $lastCol . '1');

        $widths = [5, 18, 20, 16, 20, 18, 20, 18, 16, 16, 16, 12, 14];
        $col = 'A';
        foreach ($widths as $w) {
            $sheet->getColumnDimension($col)->setWidth($w);
            $col++;
        }
    }

    protected function outputExcel(Spreadsheet $spreadsheet): void
    {
        $filename = 'laporan-kunjungan-' . date('Ymd-His') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    // HELPERS
    protected function formatPeriod(array $filters): string
    {
        $from = $filters['date_from'] ?? '';
        $to   = $filters['date_to'] ?? '';

        if (empty($from) && empty($to)) {
            return 'Semua periode';
        }

        if ($from === $to) {
            return date('d M Y', strtotime($from));
        }

        return date('d M Y', strtotime($from)) . ' — ' . date('d M Y', strtotime($to));
    }

    protected function getFilterLabels(array $filters): array
    {
        return [
            'Periode'       => ucfirst($filters['period'] ?? '-'),
            'Departemen'    => $filters['department_id'] > 0 ? 'ID ' . $filters['department_id'] : 'Semua',
            'Pegawai'       => $filters['employee_id'] > 0 ? 'ID ' . $filters['employee_id'] : 'Semua',
            'Asal Instansi' => ! empty($filters['origin_institution']) ? $filters['origin_institution'] : 'Semua',
            'Keperluan'     => $filters['visit_purpose_id'] > 0 ? 'ID ' . $filters['visit_purpose_id'] : 'Semua',
            'Status'        => ! empty($filters['status'])
                ? ucwords(str_replace('_', ' ', $filters['status']))
                : 'Semua',
        ];
    }

    protected function formatDuration(int $seconds): string
    {
        if ($seconds <= 0) {
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
