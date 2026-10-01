<?php

namespace App\Validation;

class VisitPurposeRules
{
    private static function baseRules(): array
    {
        return [
            'name' => [
                'label' => 'Nama Keperluan',
                'rules' => 'required|trim|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.',
                ],
            ],
        ];
    }

    public static function create(): array
    {
        return self::baseRules();
    }

    public static function update(int $id): array
    {
        return self::baseRules();
    }
}
