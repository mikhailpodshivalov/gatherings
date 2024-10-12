<?php

namespace App\Http\Controllers\Api\Description;

/**
 * Объявляет ошибку аутентификации API
 * @OA\Schema(
 *     title="AuthenticationError",
 *     description="Ответ на ошибку аутентификации"
 * )
 * @OA\Property(
 *     property="status",
 *     type="int",
 *     format="http-code",
 *     description="Код статуса",
 *     example="401"
 * )
 * @OA\Property(
 *     property="response",
 *     type="null",
 *     description="Пустой ответ",
 *     example="null"
 * )
 * @OA\Property(
 *     property="errors",
 *     type="object",
 *     description="Сведения об ошибках",
 *          @OA\Property(
 *              property="authentication",
 *              type="array",
 *              format="{ErrorCode: ErrorMessage}",
 *              description="Список ошибок авторизации.",
 *              @OA\Items(
 *                  type="string",
 *                  example="Ошибка аутентификации"
 *              )
 *          )
 * )
 */
interface AuthenticationError
{
}
