<?php

namespace App\Http\Controllers\Api\Description;

/**
 * Объявляет ошибку валидации API
 * @OA\Schema(
 *     title="ValidationError",
 *     description="Ответ на ошибку валидации"
 * )
 * @OA\Property(
 *     property="status",
 *     type="int",
 *     format="http-code",
 *     description="Код статуса",
 *     example="400"
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
 *              property="validation",
 *              type="object",
 *              format="{FieldPath: ErrorMessage}",
 *              description="Список ошибок валидации. Используется путь к полю (разделитель точка) в качестве ключа для объекта.",
 *              @OA\Property (
 *                  property="field.path",
 *                  type="string",
 *                  example="Поле обязательно для заполнения"
 *              )
 *          )
 * )
 */
interface ValidationError
{
}
