<?php

namespace App\Services;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

class QrCodeService
{

    public function generatePng(string $token, int $size = 300): string
    {
        $qrCode = $this->buildQrCode($token, $size);

        $writer = new PngWriter();

        $result = $writer->write($qrCode);

        return $result->getString();
    }

    public function generateSvg(string $token, int $size = 300): string
    {
        $qrCode = $this->buildQrCode($token, $size);

        $writer = new SvgWriter();

        $result = $writer->write($qrCode);

        return $result->getString();
    }

    public function generateDataUri(string $token, int $size = 300): string
    {
        $qrCode = $this->buildQrCode($token, $size);

        $writer = new PngWriter();

        $result = $writer->write($qrCode);

        return $result->getDataUri();
    }

    public function saveToFile(string $token, string $filePath, int $size = 300): bool
    {
        $qrCode = $this->buildQrCode($token, $size);

        $writer = new PngWriter();

        $result = $writer->write($qrCode);

        $directory = dirname($filePath);

        if (! is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $result->saveToFile($filePath);

        return is_file($filePath);
    }

    protected function buildQrCode(string $token, int $size): QrCode
    {
        return new QrCode(
            data: $token,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Medium,
            size: $size,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
        );
    }
}
