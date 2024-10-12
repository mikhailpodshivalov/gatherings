<?php

namespace App\Http\Controllers\Api\Description;

/**
 * Объявляет внутреннюю ошибку API
 * @OA\Schema(
 *     title="InternalError",
 *     description="Ответ на внутреннюю ошибку"
 * )
 * @OA\Property(
 *     property="status",
 *     type="int",
 *     format="http-code",
 *     description="Код статуса",
 *     example="500"
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
 *              property="internal",
 *              type="array",
 *              format="{ErrorCode: ErrorMessage}",
 *              description="Список внутренних ошибок.",
 *              @OA\Items(
 *                  type="string",
 *                  example="Не удалось подключиться к базе данных."
 *              )
 *          )
 * )
 */
interface InternalError
{
}
