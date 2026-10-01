<?php

namespace App\Controllers\Admin;

use App\Models\ActivityLogModel;
use CodeIgniter\Database\BaseBuilder;

class ActivityLogController extends BaseAjaxController
{
    protected ActivityLogModel $activityLogModel;

    public function __construct()
    {
        $this->activityLogModel = new ActivityLogModel();
    }

    protected function getModel()
    {
        return $this->activityLogModel;
    }

    protected function getPartialView(): string
    {
        return 'admin/activity_logs/_table';
    }

    protected function getDefaultOrder(): array
    {
        return [
            'activity_logs.created_at' => 'DESC',
        ];
    }

    protected function getListData(?int $perPage = null): array
    {
        $model = $this->getModel();

        $builder = $model->builder();

        $builder
            ->select(
                'activity_logs.*,
                users.username,
                users.role'
            )
            ->join(
                'users',
                'users.id = activity_logs.user_id',
                'left'
            );

        foreach ($this->getDefaultOrder() as $column => $direction) {
            $builder->orderBy($column, $direction);
        }

        $search = trim(
            (string) $this->request->getGet('search')
        );

        if ($search !== '') {
            $this->applySearch($builder, $search);
        }

        $this->applyFilters($builder);

        $perPage = $perPage ?? (int) $this->request->getGet('per_page');

        if (! in_array($perPage, $this->allowedPerPage, true)) {
            $perPage = $this->defaultPerPage;
        }

        $page = (int) $this->request->getGet('page');

        if ($page < 1) {
            $page = 1;
        }

        $countBuilder = clone $builder;
        $total = $countBuilder->countAllResults(false);

        $pageCount = $total > 0
            ? (int) ceil($total / $perPage)
            : 1;

        if ($page > $pageCount) {
            $page = $pageCount;
        }

        $offset = ($page - 1) * $perPage;

        $items = $builder
            ->limit($perPage, $offset)
            ->get()
            ->getResultArray();

        $pagination = $this->buildPaginationData(
            $page,
            $perPage,
            $total,
            $pageCount
        );

        return [
            'items' => $items,
            'pagination' => $pagination,
        ];
    }

    protected function applySearch(
        BaseBuilder $builder,
        string $search
    ): void {
        $builder
            ->groupStart()
            ->like('users.username', $search)
            ->orLike('activity_logs.activity', $search)
            ->orLike('activity_logs.module', $search)
            ->orLike('activity_logs.description', $search)
            ->groupEnd();
    }

    protected function applyFilters(
        BaseBuilder $builder
    ): void {
        $activity = (string) $this->request->getGet('activity');

        if ($activity !== '') {
            $builder->where('activity_logs.activity', $activity);
        }
    }

    public function index()
    {
        $data = $this->getListData();

        return view('admin/activity_logs/index', [
            'title' => 'Activity Log',
            'items' => $data['items'],
            'pagination' => $data['pagination'],
        ]);
    }
}
