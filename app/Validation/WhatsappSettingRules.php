<?php

namespace App\Validation;

class WhatsappSettingRules
{
    public static function update(): array
    {
        return [
            'is_enabled' => [
                'label' => 'Status Integrasi',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

            'api_url' => [
                'label' => 'API URL',
                'rules' => 'permit_empty|trim|valid_url_strict[https]|max_length[255]',
                'errors' => [
                    'trim' => '{field} tidak boleh kosong.',
                    'valid_url_strict' => '{field} harus berupa URL HTTPS yang valid.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'api_key' => [
                'label' => 'API Key',
                'rules' => 'permit_empty|trim|max_length[255]',
                'errors' => [
                    'trim' => '{field} tidak boleh kosong.',
                    'max_length' => '{field} maksimal 255 karakter.',
                ],
            ],

            'guest_enabled' => [
                'label' => 'Notifikasi Tamu',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

            'guest_template' => [
                'label' => 'Template Notifikasi Tamu',
                'rules' => 'permit_empty|trim|max_length[1000]',
                'errors' => [
                    'trim' => '{field} tidak boleh kosong.',
                    'max_length' => '{field} maksimal 1000 karakter.',
                ],
            ],

            'employee_enabled' => [
                'label' => 'Notifikasi Pegawai',
                'rules' => 'required|in_list[0,1]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

            'employee_template' => [
                'label' => 'Template Notifikasi Pegawai',
                'rules' => 'permit_empty|trim|max_length[1000]',
                'errors' => [
                    'trim' => '{field} tidak boleh kosong.',
                    'max_length' => '{field} maksimal 1000 karakter.',
                ],
            ],
        ];
    }
}
