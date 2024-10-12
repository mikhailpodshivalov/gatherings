<?php

namespace App\Helpers;

/**
 * Базовый объект сериализации. Используется для сериализации "чистых" ответов без обертки сериализации.
 */
class SerializableApiResponse extends Serializable
{
    protected ApiResponse $source;

    /**
     * Constructor
     *
     * @param ApiResponse $source
     */
    public function __construct(ApiResponse $source)
    {
        $this->source = $source;
    }

    /**
     * @inheritDoc
     */
    protected function serialize(): array
    {
        return $this->source->toApi();
    }
}
