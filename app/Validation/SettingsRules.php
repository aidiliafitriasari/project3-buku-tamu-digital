<?php

namespace App\Validation;

class SettingsRules
{
    public static function update(): array
    {
        return [
            'primary_color' => [
                'label' => 'Primary Color',
                'rules' => 'required|trim|regex_match[/^#[0-9A-Fa-f]{6}$/]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'regex_match' => '{field} harus menggunakan format warna HEX yang valid.',
                ],
            ],

            'photo_required' => [
                'label' => 'Foto Tamu',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

            'signature_required' => [
                'label' => 'Tanda Tangan',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

            'max_photo_size' => [
                'label' => 'Maksimal Ukuran Foto',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus berupa angka lebih dari 0.',
                ],
            ],

            'visit_warning' => [
                'label' => 'Batas Peringatan Kunjungan',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'is_natural_no_zero' => '{field} harus berupa angka lebih dari 0.',
                ],
            ],
        ];
    }
}
