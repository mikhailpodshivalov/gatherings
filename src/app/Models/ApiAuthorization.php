<?php

namespace App\Models;

use App\Helpers\ApiResponse;
use App\Models\Traits\ApiAuthorizable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as BaseCollection;
use Illuminate\Support\Facades\Hash;

/**
 * Данные авторизации, прикрепленные к какой либо сущности
 *
 * @property int                 $id
 * @property string              $authorizable_type
 * @property string              $authorizable_id
 * @property string              $login
 * @property string              $password
 * @property ApiAuthorizable     $authorizable
 * @property Carbon              $created_at
 * @property Carbon              $updated_at
 * @OA\Schema(
 *     title="ApiAuthorization",
 *     description="Авторизация"
 * )
 */
class ApiAuthorization extends Model implements ApiResponse
{
    use HasFactory;

    protected $table = 'api_authorization';

    protected $fillable = [
        'login',
        'password',
    ];

    /**
     * Получение сущности, к которой относится авторизация
     *
     * @return MorphTo
     */
    public function authorizable(): MorphTo
    {
        return $this->morphTo(name: 'authorizable');
    }

    /**
     * Заполнение логина и пароля для сущности авторизации.
     *
     * @param string|null $login
     * @param string|null $password
     *
     * @return void
     */
    public function setLoginAndPassword(string $login = null, string $password = null): void
    {
        if (!empty($login)) {
            $this->login = $login;
        }

        if (!empty($password)) {
            $this->password = Hash::make($password);
        }

        $this->save();
    }

    /**
     * Реализует связь с моделью сброс пароля
     *
     * @return HasMany
     */
    public function resetPassword(): HasMany
    {
        return $this->hasMany(ResetPassword::class, "authorization_id", "id");
    }

    /**
     * @inheritDoc
     * @OA\Property(
     *     property="presentation",
     *     type="object",
     *     ref="#/components/schemas/ApiPresenter",
     *     description="Информация о пользователе"
     * )
     */
    public function toApi(): array
    {
        return [
            'presentation' => $this->authorizable->getPresentation(),
        ];
    }
}
