<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

/**
 * Сериализация коллекции
 */
class SerializableCollection extends Serializable
{
    protected Collection $collection;

    /**
     * Конструктор объекта
     *
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @inheritDoc
     */
    protected function serialize(): array
    {
        return $this->collection->all();
    }
}
