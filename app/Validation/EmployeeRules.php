<?php

namespace App\Validation;

class EmployeeRules
{
    private static function baseRules(): array
    {
        return [
            'department_id' => [
                'label' => 'Bagian',
                'rules' => 'required|is_natural_no_zero',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'is_natural_no_zero' => '{field} tidak valid.',
                ],
            ],

            'name' => [
                'label' => 'Nama Pegawai',
                'rules' => 'required|trim|min_length[3]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 100 karakter.',
                ],
            ],

            'nomor_hp' => [
                'label' => 'Nomor HP',
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
        ];
    }

    public static function create(): array
    {
        $rules = self::baseRules();

        $rules['email']['rules'] .= '|is_unique[employees.email]';
        $rules['email']['errors']['is_unique'] = '{field} sudah digunakan.';

        return $rules;
    }

    public static function update(int $id): array
    {
        $rules = self::baseRules();

        $rules['email']['rules'] .= "|is_unique[employees.email,id,{$id}]";
        $rules['email']['errors']['is_unique'] = '{field} sudah digunakan.';

        return $rules;
    }
}
