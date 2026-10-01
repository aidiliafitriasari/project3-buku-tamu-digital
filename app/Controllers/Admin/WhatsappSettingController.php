<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\WhatsappSettingModel;
use App\Services\ActivityLogService;

class WhatsappSettingController extends BaseController
{
    protected WhatsappSettingModel $whatsappSettingModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->whatsappSettingModel = new WhatsappSettingModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function index()
    {
        $settings = $this->whatsappSettingModel->first();

        if (! $settings) {
            return redirect()
                ->to('/admin/dashboard')
                ->with(
                    'error',
                    'Data pengaturan WhatsApp belum tersedia.'
                );
        }

        return view('admin/whatsapp_settings/index', [
            'settings' => $settings,
        ]);
    }

    public function update()
    {
        $settings = $this->whatsappSettingModel->first();

        if (! $settings) {
            return redirect()
                ->to('/admin/dashboard')
                ->with(
                    'error',
                    'Data pengaturan WhatsApp belum tersedia.'
                );
        }

        if (! $this->validate(
            \App\Validation\WhatsappSettingRules::update()
        )) {
            return redirect()
                ->to('/admin/whatsapp-settings')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_whatsapp_settings');
        }

        $isEnabled = (int) $this->request->getPost('is_enabled');

        $apiUrl = trim((string) $this->request->getPost('api_url'));
        $apiKey = trim((string) $this->request->getPost('api_key'));

        $guestEnabled = (int) $this->request->getPost('guest_enabled');
        $guestTemplate = trim((string) $this->request->getPost('guest_template'));

        $employeeEnabled = (int) $this->request->getPost('employee_enabled');
        $employeeTemplate = trim((string) $this->request->getPost('employee_template'));

        if ($isEnabled === 0) {
            $apiUrl = null;
            $apiKey = null;
        }

        $updated = $this->whatsappSettingModel->update(
            $settings['id'],
            [
                'is_enabled'         => $isEnabled,
                'api_url'            => $apiUrl ?: null,
                'api_key'            => $apiKey ?: null,
                'guest_enabled'      => $guestEnabled,
                'guest_template'     => $guestTemplate ?: null,
                'employee_enabled'   => $employeeEnabled,
                'employee_template'  => $employeeTemplate ?: null,
            ]
        );

        if (! $updated) {
            return redirect()
                ->to('/admin/whatsapp-settings')
                ->withInput()
                ->with('error', 'Pengaturan WhatsApp gagal diperbarui.')
                ->with('form_id', 'edit_whatsapp_settings');
        }

        $this->activityLogService->log(
            'update',
            'whatsapp_settings',
            'Pengaturan WhatsApp berhasil diperbarui. ID: ' . $settings['id']
        );

        return redirect()
            ->to('/admin/whatsapp-settings')
            ->with(
                'success',
                'Pengaturan WhatsApp berhasil diperbarui.'
            );
    }
}
