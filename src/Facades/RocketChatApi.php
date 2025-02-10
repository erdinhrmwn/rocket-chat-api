<?php

namespace ErdinHrmwn\RocketChat\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static RocketChatService users()
 * @method static RocketChatService roles()
 * @method static RocketChatService permissions()
 * @method static RocketChatService groups()
 * @method static RocketChatService channels()
 * @method static RocketChatService chats()
 * @method static RocketChatService rooms()
 * @method static array getServerInfo()
 * @method static array me()
 *
 * @see \ErdinHrmwn\RocketChat\Http\RocketChatService
 */
class RocketChatApi extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'rocket-chat-api';
    }
}
