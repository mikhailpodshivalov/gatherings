<?php

namespace App\DTO;

use Illuminate\Contracts\Database\Eloquent\Builder;
use LogicException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

/**
 * Пагинация и сортировка DTO
 *
 * @property string|null $orderBy
 * @property string $direction
 * @property int $limit
 * @property int $offset
 */
class PaginationAndOrderDTO
{
    protected const DIRECTION_ASC = 'asc';
    protected const DIRECTION_DESC = 'desc';

    protected ?string $orderBy;
    protected string $direction;
    protected int $limit;
    protected int $offset;

    /**
     * DTO constructor
     *
     * @param string|null $orderBy
     * @param string      $direction
     * @param int         $limit
     * @param int         $offset
     */
    public function __construct(
        string $orderBy = null,
        string $direction = self::DIRECTION_ASC,
        int    $limit = 10,
        int    $offset = 0,
    )
    {
        if (!in_array($direction, [self::DIRECTION_ASC, self::DIRECTION_DESC])) {
            throw new LogicException("Direction should be one of [asc, desc]");
        }

        if ($limit < 10 || $limit > 100) {
            throw new LogicException("Limit should be from 10 to 100");
        }

        if ($offset < 0) {
            throw new LogicException("Offset should be more or equals 0");
        }

        $this->orderBy = $orderBy;
        $this->direction = $direction;
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * Получения параметров запроса DTO
     *
     * @param string $name
     *
     * @return int|string|null
     * @throws InternalErrorException
     */
    public function __get(string $name)
    {
        switch ($name) {
            case 'orderBy':
                return $this->orderBy;
            case 'direction':
                return $this->direction;
            case 'limit':
                return $this->limit;
            case 'offset':
                return $this->offset;
        }

        throw new InternalErrorException("Property $name is not exists");
    }

    /**
     * Передача параметров пагинации и сортировки в строитель запросов
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function hydrate(Builder $builder): Builder
    {
        if ($this->orderBy !== null) {
            switch ($this->direction) {
                case self::DIRECTION_ASC:
                    $builder = $builder->orderBy($this->orderBy);
                case self::DIRECTION_DESC:
                    $builder = $builder->orderByDesc($this->orderBy);
            }
        }

        return $builder->limit($this->limit)->offset($this->offset);
    }
}
