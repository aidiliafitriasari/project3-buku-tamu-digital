<?php

namespace App\Services;

use App\Models\ActivityLogModel;

class ActivityLogService
{
    protected ActivityLogModel $activityLogModel;

    public function __construct()
    {
        $this->activityLogModel = new ActivityLogModel();
    }

    public function log(
        string $activity,
        string $module,
        ?string $description = null,
        ?int $userId = null,
        ?int $visitId = null,
        ?int $visitStatusHistoryId = null
    ): bool {
        $data = [
            'user_id' => $userId ?? session()->get('user_id'),
            'visit_id' => $visitId,
            'visit_status_history_id' => $visitStatusHistoryId,
            'activity' => $activity,
            'module' => $module,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        return $this->activityLogModel->insert($data) !== false;
    }

    public function systemLog(
        string $activity,
        string $module,
        ?string $description = null,
        ?int $visitId = null,
        ?int $visitStatusHistoryId = null
    ): bool {
        return $this->log(
            $activity,
            $module,
            $description,
            null,
            $visitId,
            $visitStatusHistoryId
        );
    }
}
