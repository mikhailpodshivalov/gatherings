<?php

namespace App\DTO;

use App\Helpers\Serializable;

/**
 * Ответ на запрос получения количества элементов
 * @OA\Schema(
 *     title="QuantityResponse",
 *     description="Ответ на запрос получения количества элементов",
 * )
 */
class QuantityResponse extends Serializable
{
    protected int $quantity;

    /**
     * Конструктор ответа
     *
     * @param int $quantity
     */
    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @inheritDoc
     * @OA\Property(
     *     property="quantity",
     *     title="Общее количество элементов",
     *     type="integer",
     *     minimum="0",
     *     example="7",
     * ),
     */
    protected function serialize(): array
    {
        return [
            'quantity' => $this->quantity,
        ];
    }
}
