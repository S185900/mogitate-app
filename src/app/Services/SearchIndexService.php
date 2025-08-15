<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

class SearchIndexService
{
    public function searchSearchAndSort(Builder $query, array $filters): Builder
    {
        // 商品名で検索
        if (!empty($filters['name']) && $filters['name'] !== '商品名で検索') {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        // high or lowで検索
        if (isset($filters['sort']) && $filters['sort'] === 'high') {
            $query->orderBy('price', 'desc');
        } elseif (isset($filters['sort']) && $filters['sort'] === 'low') {
            $query->orderBy('price', 'asc');
        }

        return $query;
    }
}
