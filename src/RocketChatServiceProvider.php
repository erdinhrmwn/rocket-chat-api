<?php

namespace ErdinHrmwn\RocketChat;

use Illuminate\Support\ServiceProvider;

class RocketChatServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/rocketchat.php', 'rocketchat'
        );

        $this->app->bind('rocket-chat-api', Http\RocketChatService::class);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/rocketchat.php' => $this->app->configPath('rocketchat.php'),
        ], 'config');
    }
}
