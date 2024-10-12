<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;

/**
 * Ответ API в виде DTO
 */
class ApiResponse extends JsonResponse
{
    /**
     * Конструктор ответа
     *
     * @param       $data
     * @param array $errors
     * @param       $status
     * @param       $headers
     * @param       $options
     * @param       $json
     */
    public function __construct(
        $data = null,
        array $errors = [],
        $status = 200,
        $headers = [],
        $options = 0,
        $json = false,
    )
    {
        parent::__construct(
            [
                'status' => $status,
                'errors' => $errors,
                'response' => $data,
            ],
            $status,
            $headers,
            $options,
            $json
        );
    }
}
