<?php

namespace App\Models\Traits;

use App\Helpers\Serializable;

/**
 * Презентация для пользователя API
 * @OA\Schema(
 *     title="ApiPresenter",
 *     description="Презентация для пользователя API"
 * )
 */
class ApiPresenter extends Serializable
{
    protected string $id;
    protected string $name;
    protected string $email;

    /**
     * Конструктор презентации
     *
     * @param string $id
     * @param string $name
     * @param string $email
     */
    public function __construct(string $id, string $name, string $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @inheritDoc
     * @OA\Property(
     *     property="id",
     *     type="string",
     *     format="numeric",
     *     description="Идентификатор пользователя",
     *     example="1439"
     * )
     * @OA\Property(
     *     property="name",
     *     type="string",
     *     description="Имя пользователя",
     *     example="Петров Иван Иванович"
     * )
     * @OA\Property(
     *     property="email",
     *     type="string",
     *     format="email",
     *     description="E-mail пользователя",
     *     example="petrov@mail.ru"
     * )
     */
    protected function serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
