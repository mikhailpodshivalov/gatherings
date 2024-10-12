<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

/**
 * Посредник, реализующий работу с транзакциями.
 * Запустит транзакцию для переданных подключений к базе данных, закомитит или откатит ее автоматически.
 */
class TxMiddleware
{
    /**
     * Обработка запроса с помощью транзакций
     *
     * @param Request $request
     * @param Closure $next
     * @param string  ...$connections
     *
     * @return mixed
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next, string ...$connections): mixed
    {
        $connections = !empty($connections) ? $connections : [env("DB_CONNECTION")];

        $callback = fn () => $next($request);
        foreach ($connections as $connection) {
            $callback = fn () => DB::connection($connection)->transaction(fn () => $callback());
        }

        return $callback();
    }
}
