<?php

namespace App\Models\Traits;

/**
 * Интерфейс не строгого сравнения сущностей
 */
interface Comparable
{
    /**
     * Выполняет сравнение переданной сущности с текущей.
     * Сравнение глубокое. Если сущности эквивалентны, то
     * возвращается TRUE
     *
     * @param Comparable $instanceToCompare
     *
     * @return bool
     */
    public function compare(self $instanceToCompare): bool;
}
