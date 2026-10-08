<?php

namespace App\Services;

use CodeIgniter\HTTP\Files\UploadedFile;

class SignatureService
{
    protected string $uploadPath = 'uploads/visits/signatures';

    public function save(?UploadedFile $file, string $identifier): ?string
    {
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return null;
        }

        $this->validateFile($file);

        $extension = $this->getSafeExtension($file);
        $fileName  = $this->generateFileName($identifier, $extension);

        $subFolder = date('Y/m');
        $targetDir = FCPATH . $this->uploadPath . '/' . $subFolder;

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file->move($targetDir, $fileName);

        return $this->uploadPath . '/' . $subFolder . '/' . $fileName;
    }

    public function delete(?string $path): bool
    {
        if (empty($path)) {
            return false;
        }

        $fullPath = FCPATH . $path;

        if (is_file($fullPath)) {
            return unlink($fullPath);
        }

        return false;
    }

    protected function validateFile(UploadedFile $file): void
    {
        $allowedExt = ['png', 'jpg', 'jpeg'];

        $allowedMime = [
            'image/png',
            'image/jpeg',
        ];

        $ext = strtolower($file->getExtension());

        if (! in_array($ext, $allowedExt, true)) {
            throw new \RuntimeException(
                'Ekstensi tanda tangan tidak valid. Gunakan PNG atau JPG.'
            );
        }

        $realMime = $this->detectMimeType($file->getTempName());

        if (! in_array($realMime, $allowedMime, true)) {
            throw new \RuntimeException(
                'Format tanda tangan tidak valid. Gunakan PNG atau JPG.'
            );
        }

        $maxSizeBytes = 1024 * 1024;

        if ($file->getSize() > $maxSizeBytes) {
            throw new \RuntimeException(
                'Ukuran tanda tangan maksimal 1 MB.'
            );
        }

        $imageInfo = @getimagesize($file->getTempName());

        if ($imageInfo === false) {
            throw new \RuntimeException(
                'File yang diunggah bukan gambar yang valid.'
            );
        }
    }

    protected function detectMimeType(string $filePath): string
    {
        if (! function_exists('finfo_open')) {
            // Fallback ke mime_content_type
            return mime_content_type($filePath) ?: '';
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        if ($finfo === false) {
            return mime_content_type($filePath) ?: '';
        }

        $mime = finfo_file($finfo, $filePath);
        finfo_close($finfo);

        return $mime ?: '';
    }

    protected function getSafeExtension(UploadedFile $file): string
    {
        $ext = strtolower($file->getExtension());

        if ($ext === 'jpeg') {
            $ext = 'jpg';
        }

        return $ext;
    }

    protected function generateFileName(string $identifier, string $extension): string
    {
        $identifier = preg_replace('/[^A-Za-z0-9\-]/', '', $identifier);
        $identifier = substr($identifier, 0, 40);

        $timestamp = date('YmdHis');
        $random    = bin2hex(random_bytes(8));

        return sprintf(
            'signature_%s_%s_%s.%s',
            $identifier,
            $timestamp,
            $random,
            $extension
        );
    }
}
