<?php

namespace App\Services\SyncUsersService\Facades;

use Illuminate\Support\Facades\Facade;

class SyncUsers extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'sync_users';
    }
}
