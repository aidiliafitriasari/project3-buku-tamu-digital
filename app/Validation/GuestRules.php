<?php

namespace App\Validation;

use App\Models\DepartmentModel;
use App\Models\EmployeeModel;
use App\Models\VisitPurposeModel;

class GuestRules
{
    public static function register(
        bool $photoRequired = true,
        bool $signatureRequired = true
    ): array {
        $rules = [
            'name' => [
                'label' => 'Nama Lengkap',
                'rules' => [
                    'required',
                    'min_length[3]',
                    'max_length[100]',
                ],
                'errors' => [
                    'required'   => 'Nama lengkap wajib diisi.',
                    'min_length' => 'Nama lengkap minimal 3 karakter.',
                    'max_length' => 'Nama lengkap maksimal 100 karakter.',
                ],
            ],

            'phone' => [
                'label' => 'Nomor HP',
                'rules' => [
                    'required',
                    'regex_match[/^(\+62|62|0)8[1-9][0-9]{6,11}$/]',
                    'max_length[20]',
                ],
                'errors' => [
                    'required'    => 'Nomor HP wajib diisi.',
                    'regex_match' => 'Format nomor HP tidak valid. Contoh: 081234567890.',
                    'max_length'  => 'Nomor HP maksimal 20 karakter.',
                ],
            ],

            'address' => [
                'label' => 'Alamat',
                'rules' => [
                    'required',
                    'min_length[5]',
                    'max_length[255]',
                ],
                'errors' => [
                    'required'   => 'Alamat wajib diisi.',
                    'min_length' => 'Alamat minimal 5 karakter.',
                    'max_length' => 'Alamat maksimal 255 karakter.',
                ],
            ],

            'identity_type' => [
                'label' => 'Jenis Identitas',
                'rules' => [
                    'required',
                    'in_list[ktp,sim,paspor,kartu_pelajar,kartu_mahasiswa,lainnya]',
                ],
                'errors' => [
                    'required' => 'Jenis identitas wajib dipilih.',
                    'in_list'  => 'Jenis identitas tidak valid.',
                ],
            ],

            'identity_number' => [
                'label' => 'Nomor Identitas',
                'rules' => [
                    'required',
                    'min_length[3]',
                    'max_length[50]',
                ],
                'errors' => [
                    'required'   => 'Nomor identitas wajib diisi.',
                    'min_length' => 'Nomor identitas minimal 3 karakter.',
                    'max_length' => 'Nomor identitas maksimal 50 karakter.',
                ],
            ],

            'origin_institution' => [
                'label' => 'Asal Instansi',
                'rules' => [
                    'required',
                    'min_length[3]',
                    'max_length[150]',
                ],
                'errors' => [
                    'required'   => 'Asal instansi/perusahaan wajib diisi.',
                    'min_length' => 'Asal instansi minimal 3 karakter.',
                    'max_length' => 'Asal instansi maksimal 150 karakter.',
                ],
            ],

            'department_id' => [
                'label' => 'Departemen Tujuan',
                'rules' => [
                    'required',
                    'is_natural_no_zero',
                    'is_active_department',
                ],
                'errors' => [
                    'required'             => 'Departemen tujuan wajib dipilih.',
                    'is_natural_no_zero'   => 'Departemen tujuan tidak valid.',
                    'is_active_department' => 'Departemen tujuan tidak aktif.',
                ],
            ],

            'employee_id' => [
                'label' => 'Pegawai Tujuan',
                'rules' => [
                    'required',
                    'is_natural_no_zero',
                    'is_active_employee',
                ],
                'errors' => [
                    'required'           => 'Pegawai tujuan wajib dipilih.',
                    'is_natural_no_zero' => 'Pegawai tujuan tidak valid.',
                    'is_active_employee' => 'Pegawai tujuan tidak aktif.',
                ],
            ],

            'visit_purpose_id' => [
                'label' => 'Keperluan Kunjungan',
                'rules' => [
                    'required',
                    'is_natural_no_zero',
                    'is_active_visit_purpose',
                ],
                'errors' => [
                    'required'                => 'Keperluan kunjungan wajib dipilih.',
                    'is_natural_no_zero'      => 'Keperluan kunjungan tidak valid.',
                    'is_active_visit_purpose' => 'Keperluan kunjungan tidak aktif.',
                ],
            ],

            'group_count' => [
                'label' => 'Jumlah Rombongan',
                'rules' => [
                    'required',
                    'is_natural_no_zero',
                    'greater_than_equal_to[1]',
                    'less_than_equal_to[100]',
                ],
                'errors' => [
                    'required'              => 'Jumlah rombongan wajib diisi.',
                    'is_natural_no_zero'    => 'Jumlah rombongan harus angka bulat positif.',
                    'greater_than_equal_to' => 'Jumlah rombongan minimal 1 orang.',
                    'less_than_equal_to'    => 'Jumlah rombongan maksimal 100 orang.',
                ],
            ],

            'data_consent' => [
                'label' => 'Persetujuan Penggunaan Data',
                'rules' => [
                    'required',
                    'in_list[1]',
                ],
                'errors' => [
                    'required' => 'Anda harus menyetujui penggunaan data.',
                    'in_list'  => 'Anda harus menyetujui penggunaan data.',
                ],
            ],
        ];

        if ($photoRequired) {
            $rules['photo'] = [
                'label' => 'Foto Tamu',
                'rules' => [
                    'uploaded[photo]',
                    'ext_in[photo,jpg,jpeg,png,webp]',
                    'max_size[photo,2048]',
                ],
                'errors' => [
                    'uploaded' => 'Foto wajib diambil atau diupload.',
                    'ext_in'   => 'Ekstensi foto tidak valid.',
                    'max_size' => 'Ukuran foto maksimal 2 MB.',
                ],
            ];
        }

        if ($signatureRequired) {
            $rules['signature'] = [
                'label' => 'Tanda Tangan',
                'rules' => [
                    'uploaded[signature]',
                    'ext_in[signature,png,jpg,jpeg]',
                    'max_size[signature,1024]',
                ],
                'errors' => [
                    'uploaded' => 'Tanda tangan wajib diisi.',
                    'ext_in'   => 'Ekstensi tanda tangan tidak valid.',
                    'max_size' => 'Ukuran tanda tangan maksimal 1 MB.',
                ],
            ];
        }

        return $rules;
    }
}
