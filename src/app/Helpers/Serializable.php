<?php

namespace App\Helpers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;

/**
 * Declares functionality to serialize response. Required for API.
 */
abstract class Serializable implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * @inheritDoc
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize());
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->serializeData($this->serialize());
    }

    /**
     * Serialize data to available to API format
     *
     * @param mixed $data
     *
     * @return mixed
     */
    private function serializeData(mixed $data): mixed
    {
        if (is_array($data)) {
            return array_map(fn($value) => $this->serializeData($value), $data);
        }

        if ($data instanceof Collection) {
            return $data->map(fn($value) => $this->serializeData($value))->toArray();
        }

        if ($data instanceof ApiResponse) {
            return $this->serializeData($data->toApi());
        }

        if (is_string($data)
            || is_int($data)
            || is_float($data)
            || is_bool($data)
            || is_null($data)
        ) {
            return $data;
        }

        return json_decode(json_encode($data), true);
    }

    /**
     * Serialize data to array. Should return associative array data of object.
     *
     * @return array
     */
    abstract protected function serialize(): array;
}
