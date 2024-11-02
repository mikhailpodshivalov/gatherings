<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Модель для работы со сбросом пароля для API авторизации
 *
 * @property string $id
 * @property integer $apiAuthorization_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property ApiAuthorization $apiAuthorization Должно использоваться `with` при доступе к этому свойству для нескольких объектов
 */
class ResetPassword extends Model
{
    use HasFactory;
    protected $table = "reset_passwords";
    protected $keyType = "string";

    /**
     * Атрибуты, которые можно массово присваивать.
     *
     * @var array
     */
    protected $fillable = [
        'authorization_id',
    ];

    /**
     * Реализует связь с моделью API авторизацией
     *
     * @return BelongsTo
     */
    public function apiAuthorization(): BelongsTo
    {
        return $this->belongsTo(ApiAuthorization::class, "authorization_id", "id");
    }

    /**
     * Регистрация событий сохранения для модели
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Generate UUID for model ID
        parent::creating(function (self $model) {
            $model->id = Str::uuid();
        });
    }
}
