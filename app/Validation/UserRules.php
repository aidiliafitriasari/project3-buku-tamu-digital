<?php

namespace App\Validation;

class UserRules
{
    public static function create(): array
    {
        return [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|trim|min_length[3]|max_length[50]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 50 karakter.',
                    'is_unique' => '{field} sudah digunakan.',
                ],
            ],

            'email' => [
                'label' => 'Email',
                'rules' => 'required|trim|valid_email|max_length[255]|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'valid_email' => '{field} harus menggunakan format email yang valid.',
                    'max_length' => '{field} maksimal 255 karakter.',
                    'is_unique' => '{field} sudah digunakan.',
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

            'role' => [
                'label' => 'Role',
                'rules' => 'required|in_list[administrator,petugas]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],

            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 8 karakter.',
                ],
            ],

            'password_confirmation' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} harus sama dengan Password.',
                ],
            ],
        ];
    }

    public static function update(int $id): array
    {
        return [
            'username' => [
                'label' => 'Username',
                'rules' => "required|trim|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'min_length' => '{field} minimal 3 karakter.',
                    'max_length' => '{field} maksimal 50 karakter.',
                    'is_unique' => '{field} sudah digunakan.',
                ],
            ],

            'email' => [
                'label' => 'Email',
                'rules' => "required|trim|valid_email|max_length[255]|is_unique[users.email,id,{$id}]",
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'trim' => '{field} tidak boleh kosong.',
                    'valid_email' => '{field} harus menggunakan format email yang valid.',
                    'max_length' => '{field} maksimal 255 karakter.',
                    'is_unique' => '{field} sudah digunakan.',
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

            'role' => [
                'label' => 'Role',
                'rules' => 'required|in_list[administrator,petugas]',
                'errors' => [
                    'required' => '{field} wajib dipilih.',
                    'in_list' => '{field} tidak valid.',
                ],
            ],
        ];
    }

    public static function resetPassword(): array
    {
        return [
            'password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 8 karakter.',
                ],
            ],

            'password_confirmation' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'matches' => '{field} harus sama dengan Password Baru.',
                ],
            ],
        ];
    }
}
