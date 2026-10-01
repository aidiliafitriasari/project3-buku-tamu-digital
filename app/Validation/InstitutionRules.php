<?php

namespace App\Validation;

class InstitutionRules
{
    public static function update(): array
    {
        return [
            'name' => [
                'label' => 'Nama Instansi',
                'rules' => 'required|trim|min_length[3]|max_length[150]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 150 karakter.',
                ],
            ],

            'address' => [
                'label' => 'Alamat',
                'rules' => 'required|trim|min_length[10]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal 10 karakter.',
                ],
            ],

            'phone' => [
                'label' => 'Nomor Telepon',
                'rules' => 'required|trim|regex_match[/^(?:\+62|62|0)8[1-9][0-9]{7,11}$/]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'regex_match' => '{field} harus menggunakan format nomor Indonesia yang valid.',
                ],
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'required|trim|valid_email|max_length[255]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'valid_email' => '{field} harus menggunakan format email yang valid.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'logo' => [
                'label' => 'Logo Instansi',
                'rules' => 'permit_empty|is_image[logo]|mime_in[logo,image/jpeg,image/png,image/webp]',
                'errors' => [
                    'is_image' => '{field} harus berupa file gambar.',
                    'mime_in' => '{field} hanya boleh JPG, JPEG, PNG, atau WebP.',
                ],
            ],
        ];
    }
}
