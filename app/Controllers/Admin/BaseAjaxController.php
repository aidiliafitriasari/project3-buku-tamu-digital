<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseBuilder;

abstract class BaseAjaxController extends BaseController
{
    protected int $defaultPerPage = 50;

    protected array $allowedPerPage = [
        50,
        100,
        250,
        500,
    ];

    abstract protected function getModel();

    abstract protected function getPartialView(): string;

    abstract protected function applySearch(
        BaseBuilder $builder,
        string $search
    ): void;

    abstract protected function applyFilters(
        BaseBuilder $builder
    ): void;

    protected function getDefaultOrder(): array
    {
        return [
            'id' => 'DESC',
        ];
    }

    protected function getListData(?int $perPage = null): array
    {
        $model = $this->getModel();

        $builder = $model->builder();

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

        $total = $builder->countAllResults(false);

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

    public function partial()
    {
        $data = $this->getListData();

        $html = view($this->getPartialView(), [
            'items' => $data['items'],
            'pagination' => $data['pagination'],
        ]);

        return $this->response->setJSON([
            'html' => $html,
            'pagination' => $data['pagination'],
        ]);
    }

    protected function buildPaginationData(
        int $page,
        int $perPage,
        int $total,
        ?int $pageCount = null
    ): array {
        if ($pageCount === null) {
            $pageCount = $total > 0
                ? (int) ceil($total / $perPage)
                : 1;
        }

        if ($pageCount < 1) {
            $pageCount = 1;
        }

        $start = $total > 0
            ? (($page - 1) * $perPage) + 1
            : 0;

        $end = $total > 0
            ? min($page * $perPage, $total)
            : 0;

        return [
            'total' => $total,
            'page' => $page,
            'pageCount' => $pageCount,
            'start' => $start,
            'end' => $end,
            'perPage' => $perPage,
        ];
    }
}
