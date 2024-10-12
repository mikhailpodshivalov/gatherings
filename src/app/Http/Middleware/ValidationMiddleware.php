<?php

namespace App\Http\Middleware;

use App\Validation\Validator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as BaseValidator;
use Illuminate\Validation\ValidationException;

/**
 * Посредник для проверки валидации запросов
 */
class ValidationMiddleware
{
    protected array $validators;

    /**
     * Middleware constructor
     *
     * @param Validator ...$validator
     */
    public function __construct(Validator...$validator)
    {
        $this->validators = $validator;
    }

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
        try {
            // Combine all request data and route parameters
            $requestData = [
                ...($request->route()->parameters() ?? []),
                ...$request->all(),
            ];

            /** @var Validator $validator */
            foreach ($this->validators as $validator) {
                BaseValidator::make($requestData, $validator->requestRules())->validate();
            }
        } catch (ValidationException $exception) {
            return new ApiResponse(null, [
                'validation' => $exception->errors()
            ], 400);
        }

        return $next($request);
    }
}
