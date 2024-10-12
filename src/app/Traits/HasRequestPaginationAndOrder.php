<?php

namespace App\Traits;

use App\DTO\PaginationAndOrderDTO;
use Illuminate\Http\Request;

/**
 * Предоставляет функционал для парсинга параметров пагинации, сортировки, ограничения и смещения из запроса
 */
trait HasRequestPaginationAndOrder
{
    /**
     * Парсит запрос на параметры пагинации, сорировки, ограничения и смещения возвращает результат в виде объекта PaginationAndOrderDTO
     *
     * @param Request     $request
     * @param array       $replaceOrderByMap
     * @param string|null $defaultOrderField
     *
     * @return PaginationAndOrderDTO
     */
    protected function parseRequestPaginationAndOrder(
        Request $request,
        array $replaceOrderByMap = [],
        string $defaultOrderField = null,
    ): PaginationAndOrderDTO
    {
        $orderBy = $request->orderBy ?? $defaultOrderField;
        $direction = $request->direction ?? 'asc';
        $orderBy = !!$orderBy && array_key_exists($orderBy, $replaceOrderByMap)
            ? $replaceOrderByMap[$orderBy]
            : null
        ;
        $limit = $request->limit ?? 10;
        $offset = $request->offset ?? 0;

        return new PaginationAndOrderDTO(
            orderBy: $orderBy,
            direction: $direction,
            limit: $limit,
            offset: $offset,
        );
    }
}
