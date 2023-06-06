<?php

namespace App\Services\ApiRequestService\Facades;

use Illuminate\Support\Facades\Facade;

class ApiRequest extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'api_request';
    }
}
