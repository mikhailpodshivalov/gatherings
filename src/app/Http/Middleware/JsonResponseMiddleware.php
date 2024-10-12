<?php

namespace App\Http\Middleware;

use App\Helpers\ApiResponse as ApiResponseInterface;
use App\Helpers\Serializable;
use App\Helpers\SerializableApiResponse;
use App\Helpers\SerializableCollection;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

/**
 * Реализует формат ответа для API
 */
class JsonResponseMiddleware
{
    /**
     * Проверяет запрос с помощью предварительно настроенных валидаторов
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        /** @var Response $response */
        $response = $next($request);

        switch (true) {
            case $response instanceof ApiResponse:
                return $response;
            case $response instanceof JsonResponse:
                return new ApiResponse(
                    $this->serializeResponse($response->getOriginalContent()),
                    [],
                    $response->getStatusCode(),
                    $response->headers->all(),
                );
            case $response instanceof Response:
                return new ApiResponse(
                    json_decode($response->getContent(), true),
                    [],
                    $response->getStatusCode(),
                    $response->headers->all(),
                );
        }

        return new ApiResponse(
            $response,
            [],
            Response::HTTP_OK
        );
    }

    /**
     * Сериализует ответ в формат для API
     *
     * @param mixed $response
     *
     * @return array
     */
    protected function serializeResponse(mixed $response): array
    {
        if ($response instanceof Serializable) {
            return $response->toArray();
        }

        if ($response instanceof ApiResponseInterface) {
            return (new SerializableApiResponse($response))->toArray();
        }

        if ($response instanceof Collection) {
            return (new SerializableCollection($response))->toArray();
        }

        return json_decode(json_encode($response), true);
    }
}
