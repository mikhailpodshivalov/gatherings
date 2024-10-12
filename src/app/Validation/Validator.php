<?php

namespace App\Validation;

/**
 * Объявляет интерфейс валидатора. Валидатор должен содержать правила проверки запроса..
 */
interface Validator
{
    /**
     * Возвращает правила валидации для запроса
     *
     * @return array
     */
    public function requestRules(): array;
}
