<?php

namespace App\Http\Controllers\Api\Description;

/**
 * Объявляет логическую ошибку API
 * @OA\Schema(
 *     title="LogicalError",
 *     description="Ответ на логическую ошибку"
 * )
 * @OA\Property(
 *     property="status",
 *     type="int",
 *     format="http-code",
 *     description="Код статуса",
 *     example="409"
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
 *              property="logical",
 *              type="array",
 *              format="{ErrorCode: ErrorMessage}",
 *              description="Список логических ошибок.",
 *              @OA\Items(
 *                  type="string",
 *                  example="Назначение компании должно иметь тот же адрес электронной почты, что и у пользователя"
 *              )
 *          )
 * )
 */
interface LogicalError
{
}
