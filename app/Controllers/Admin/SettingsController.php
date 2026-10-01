<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SettingModel;
use App\Services\ActivityLogService;

class SettingsController extends BaseController
{
    protected SettingModel $settingModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function index()
    {
        $settings = $this->settingModel->first();

        if (! $settings) {
            return redirect()
                ->to('/admin/dashboard')
                ->with(
                    'error',
                    'Data pengaturan sistem belum tersedia.'
                );
        }

        return view('admin/settings/index', [
            'settings' => $settings,
        ]);
    }

    public function update()
    {
        $settings = $this->settingModel->first();

        if (! $settings) {
            return redirect()
                ->to('/admin/dashboard')
                ->with(
                    'error',
                    'Data pengaturan sistem belum tersedia.'
                );
        }

        if (! $this->validate(
            \App\Validation\SettingsRules::update()
        )) {
            return redirect()
                ->to('/admin/settings')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_settings');
        }

        $primaryColor = trim(
            (string) $this->request->getPost('primary_color')
        );

        $photoRequired = (int) $this->request->getPost(
            'photo_required'
        );

        $signatureRequired = (int) $this->request->getPost(
            'signature_required'
        );

        $maxPhotoSize = (int) $this->request->getPost(
            'max_photo_size'
        );

        $visitWarning = (int) $this->request->getPost(
            'visit_warning'
        );

        $updated = $this->settingModel->update(
            $settings['id'],
            [
                'primary_color'      => $primaryColor,
                'photo_required'     => $photoRequired,
                'signature_required' => $signatureRequired,
                'max_photo_size'     => $maxPhotoSize,
                'visit_warning'      => $visitWarning,
            ]
        );

        if (! $updated) {
            return redirect()
                ->to('/admin/settings')
                ->withInput()
                ->with('error', 'Pengaturan sistem gagal diperbarui.')
                ->with('form_id', 'edit_settings');
        }

        session()->set('app_primary_color', $primaryColor);

        $this->activityLogService->log(
            'update',
            'settings',
            'Pengaturan sistem berhasil diperbarui. ID: ' . $settings['id']
        );

        return redirect()
            ->to('/admin/settings')
            ->with(
                'success',
                'Pengaturan sistem berhasil diperbarui.'
            );
    }
}
