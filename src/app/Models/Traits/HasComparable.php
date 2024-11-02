<?php

namespace App\Models\Traits;

use Illuminate\Support\Collection;

/**
 * Содержит в себе функционал для работы с интерфейсом сравнения.
 */
trait HasComparable
{
    /**
     * Сравнение 2х коллекций на предмет эквивалентности.
     * Вычисляет расхождения между коллекциями. Если есть расхождения,
     * то коллекции не эквивалентны.
     *
     * @param Collection<Comparable> $a
     * @param Collection<Comparable> $b
     *
     * @return bool
     */
    public function compareCollections(Collection $a, Collection $b): bool
    {
        $aDiffs = $a->diffUsing(
            $b,
            fn (Comparable $a, Comparable $b) => $a->compare($b) ? 0 : 1
        );

        $bDiffs = $b->diffUsing(
            $a,
            fn (Comparable $a, Comparable $b) => $a->compare($b) ? 0 : 1
        );

        return $aDiffs->isEmpty() && $bDiffs->isEmpty();
    }
}
