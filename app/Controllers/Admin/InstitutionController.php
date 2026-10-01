<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\InstitutionProfileModel;
use App\Services\ActivityLogService;

class InstitutionController extends BaseController
{
    protected InstitutionProfileModel $institutionModel;
    protected ActivityLogService $activityLogService;

    public function __construct()
    {
        $this->institutionModel = new InstitutionProfileModel();
        $this->activityLogService = new ActivityLogService();
    }

    public function index()
    {
        $institution = $this->institutionModel->first();

        if (! $institution) {
            return redirect()
                ->to('/admin/dashboard')
                ->with(
                    'error',
                    'Data identitas instansi belum tersedia.'
                );
        }

        return view('admin/institution/index', [
            'institution' => $institution,
        ]);
    }

    public function update()
    {
        $institution = $this->institutionModel->first();

        if (! $institution) {
            return redirect()
                ->to('/admin/dashboard')
                ->with(
                    'error',
                    'Data identitas instansi belum tersedia.'
                );
        }

        if (! $this->validate(
            \App\Validation\InstitutionRules::update()
        )) {
            return redirect()
                ->to('/admin/institution')
                ->withInput()
                ->with('errors', $this->validator->getErrors())
                ->with('form_id', 'edit_institution');
        }

        $logo = $this->request->getFile('logo');

        if ($logo && $logo->isValid() && ! $logo->hasMoved()) {
            $maxSizeBytes = 2048 * 1024;

            if ($logo->getSize() > $maxSizeBytes) {
                $fileSizeMb = round($logo->getSize() / 1024 / 1024, 2);

                return redirect()
                    ->to('/admin/institution')
                    ->withInput()
                    ->with('errors', [
                        'logo' => "Logo Instansi maksimal 2 MB. File Anda {$fileSizeMb} MB.",
                    ])
                    ->with('form_id', 'edit_institution');
            }
        }

        $name    = trim((string) $this->request->getPost('name'));
        $address = trim((string) $this->request->getPost('address'));
        $phone   = trim((string) $this->request->getPost('phone'));
        $email   = trim((string) $this->request->getPost('email'));

        $oldLogo = $institution['logo'];
        $newLogo = $oldLogo;

        if ($logo && $logo->isValid() && ! $logo->hasMoved()) {

            $uploadPath = FCPATH . 'uploads/institution';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $newFileName = $logo->getRandomName();

            // 🔥 CEK HASIL MOVE
            if (! $logo->move($uploadPath, $newFileName)) {

                return redirect()
                    ->to('/admin/institution')
                    ->withInput()
                    ->with('error', 'Logo Instansi gagal diunggah. Silakan coba lagi.')
                    ->with('form_id', 'edit_institution');
            }

            $newLogo = 'uploads/institution/' . $newFileName;
        }

        $updated = $this->institutionModel->update(
            $institution['id'],
            [
                'name'    => $name,
                'address' => $address,
                'phone'   => $phone,
                'email'   => $email,
                'logo'    => $newLogo,
            ]
        );

        if (! $updated) {

            if (
                $newLogo !== $oldLogo &&
                is_file(FCPATH . $newLogo)
            ) {
                unlink(FCPATH . $newLogo);
            }

            return redirect()
                ->to('/admin/institution')
                ->withInput()
                ->with('error', 'Data identitas instansi gagal diperbarui.')
                ->with('form_id', 'edit_institution');
        }

        if (
            $newLogo !== $oldLogo &&
            ! empty($oldLogo) &&
            is_file(FCPATH . $oldLogo)
        ) {
            unlink(FCPATH . $oldLogo);
        }

        $this->activityLogService->log(
            'update',
            'institution_profiles',
            'Identitas instansi berhasil diperbarui. ID: ' . $institution['id']
        );

        return redirect()
            ->to('/admin/institution')
            ->with(
                'success',
                'Identitas instansi berhasil diperbarui.'
            );
    }
}
