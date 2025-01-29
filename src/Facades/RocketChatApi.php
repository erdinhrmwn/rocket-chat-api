<?php

namespace ErdinHrmwn\RocketChat\Facades;

use Illuminate\Support\Facades\Facade;

class RocketChatApi extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rocket-chat-api';
    }
}
