<?php

namespace App\Models\Traits;

use App\Models\ApiAuthorization;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Трейт подключения функционала авторизации к модели сущности
 *
 * @property ApiAuthorization $authorization
 * @property string           $password
 */
trait HasApiAuthorizable
{
    /**
     * Отношение к авторизации для родительской сущности
     *
     * @return MorphOne
     */
    public function authorization(): MorphOne
    {
        return $this->morphOne(
            related: ApiAuthorization::class,
            name: 'authorizable',
        );
    }

    /**
     * Изменение пароля авторизации
     *
     * @param string $password
     *
     * @return void
     */
    public function changePassword(string $password): void
    {
        $this->authorization->setLoginAndPassword(password: $password);
    }

    /**
     * Изменение логина для авторизации
     *
     * @param string $login
     *
     * @return void
     */
    protected function changeLogin(string $login): void
    {
        $this->authorization->setLoginAndPassword(login: $login);
    }

    /**
     * Обертка, позволяющая получить доступ к хэшу пароля напрямую, из
     * основной сущности.
     *
     * @return Attribute
     */
    public function password(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->authorization->password,
            set: fn($value) => $this->authorization->password = $value,
        );
    }
}
