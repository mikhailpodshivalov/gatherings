<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use LogicException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

/**
 * Обработка ошибок, возникших при обработке запросов к API
 */
class ErrorMiddleware
{
    /**
     * Обрабатывает исключения, возникающие в ходе работы и преобразовывает
     * их в формат ошибки API.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            /** @var JsonResponse $response */
            $response = $next($request);

            if (!!$response->exception) {
                throw $response->exception;
            }

            return $response;
        } catch (LogicException $exception) {
            return new ApiResponse(null, [
                'logical' => [
                    $exception->getCode() => $exception->getMessage(),
                ]
            ], Response::HTTP_CONFLICT);
        } catch (AuthenticationException $exception) {
            return new ApiResponse(null, [
                'authentication' => [
                    Response::HTTP_UNAUTHORIZED => $exception->getMessage(),
                ]
            ], Response::HTTP_UNAUTHORIZED);
        } catch (ModelNotFoundException $exception) {
            return new ApiResponse(null, [
                'logical' => [
                    Response::HTTP_NOT_FOUND => $exception->getMessage(),
                ]
            ], Response::HTTP_NOT_FOUND);
        } catch (Throwable $exception) {
            return new ApiResponse(null, [
                'internal' => [
                    $exception->getMessage(),
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
