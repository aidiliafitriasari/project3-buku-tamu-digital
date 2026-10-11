<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WhatsappSettingsSeeder extends Seeder
{
    public function run()
    {
        $exists = $this->db
            ->table('whatsapp_settings')
            ->countAllResults();

        if ($exists === 0) {
            $this->db->table('whatsapp_settings')->insert([
                'is_enabled'       => false,
                'api_url'          => "https://wakita.aminsproject.com/api/v1",
                'api_key'          => "wgk_10_9332dd417c61c2363ca6d63cb03fad71",
                'guest_enabled'   => true,
                'guest_template'  => "Halo {nama_tamu},\n\n"
                    . "Kunjungan Anda telah diverifikasi oleh petugas.\n\n"
                    . "📋 Detail Kunjungan:\n"
                    . "• Kode: {kode_kunjungan}\n"
                    . "• Instansi: {instansi}\n"
                    . "• Departemen: {departemen}\n"
                    . "• Pegawai: {nama_pegawai}\n"
                    . "• Keperluan: {keperluan}\n"
                    . "• Rombongan: {rombongan} orang\n"
                    . "• Waktu: {waktu}\n\n"
                    . "🔑 Link QR Code kunjungan Anda:\n"
                    . "{link_qr}\n\n"
                    . "Simpan pesan ini untuk checkout.\n\n"
                    . "Terima kasih.",
                'employee_enabled' => true,
                'employee_template' => "Halo {nama_pegawai},\n\n"
                    . "Ada tamu yang ingin menemui Anda:\n\n"
                    . "• Nama: {nama_tamu}\n"
                    . "• Instansi: {instansi}\n"
                    . "• Keperluan: {keperluan}\n"
                    . "• Rombongan: {rombongan} orang\n\n"
                    . "Apakah Anda memiliki waktu untuk menemui tamu tersebut? "
                    . "Mohon konfirmasi ke resepsionis.\n\n"
                    . "Terima kasih.",
                'created_at'       => date('Y-m-d H:i:s'),
                'updated_at'       => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
