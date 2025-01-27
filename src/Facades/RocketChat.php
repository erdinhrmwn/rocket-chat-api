<?php

namespace ErdinHrmwn\RocketChat\Facades;

use Illuminate\Support\Facades\Facade;

class RocketChat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rocket-chat';
    }
}
