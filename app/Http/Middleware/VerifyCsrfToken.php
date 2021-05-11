<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'stripe/*',
        '/project_list',
        '/set_price',
        '/notification_count',
        '/message_count',
        '/messenger_result',
        '/sendMsg',
        '/message_user_count',
        '/messenger_result_U',
        '/sendMsg_U',
    ];
}
