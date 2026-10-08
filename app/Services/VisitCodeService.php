<?php

namespace App\Services;

use App\Models\VisitModel;

class VisitCodeService
{
    protected VisitModel $visitModel;

    public function __construct()
    {
        $this->visitModel = new VisitModel();
    }

    public function generateVisitCode(): string
    {
        $date = date('Ymd');
        $prefix = 'BT-' . $date . '-';

        $lastVisit = $this->visitModel
            ->withDeleted()
            ->like('visit_code', $prefix, 'after')
            ->orderBy('visit_code', 'DESC')
            ->first();

        if ($lastVisit) {
            $lastNumber = (int) substr($lastVisit['visit_code'], -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $sequence = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $code = $prefix . $sequence;

        $attempts = 0;

        while ($this->visitModel->withDeleted()->where('visit_code', $code)->first()) {
            $attempts++;
            $nextNumber++;
            $sequence = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
            $code = $prefix . $sequence;

            if ($attempts >= 10) {
                $code = $prefix . strtoupper(bin2hex(random_bytes(2)));
                break;
            }
        }

        return $code;
    }

    public function generateQrToken(): string
    {
        $attempts = 0;

        do {
            $token = bin2hex(random_bytes(16));
            $attempts++;

            $exists = $this->visitModel
                ->withDeleted()
                ->where('qr_token', $token)
                ->first();

            if ($attempts >= 10) {
                $token = hash('sha256', uniqid('', true) . random_bytes(8));
                break;
            }
        } while ($exists);

        return $token;
    }

    public function generate(): array
    {
        return [
            'visit_code' => $this->generateVisitCode(),
            'qr_token'   => $this->generateQrToken(),
        ];
    }
}
