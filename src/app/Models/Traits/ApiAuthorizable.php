<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * Интерфейс модели, которая использует авторизацию API
 */
interface ApiAuthorizable
{
    /**
     * Изменение пароля авторизации в API
     *
     * @param string $password
     *
     * @return void
     */
    public function changePassword(string $password): void;

    /**
     * Обертка, позволяющая получить доступ к хэшу пароля напрямую, из
     * основной сущности.
     *
     * @return Attribute
     */
    public function password(): Attribute;

    /**
     * Получение данных презентации пользователя.
     * По сути то, что необходимо выводить в шапке приложения.
     *
     * @return ApiPresenter
     */
    public function getPresentation(): ApiPresenter;
}
