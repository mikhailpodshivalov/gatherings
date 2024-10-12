<?php

namespace App\Helpers;

/**
 * Declare interface of API response generator for objects
 */
interface ApiResponse
{
    /**
     * Format object data to valid API response
     *
     * @return array
     */
    public function toApi(): array;
}
