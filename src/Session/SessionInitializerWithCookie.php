<?php

declare(strict_types=1);

namespace ChangHorizon\ScopedStorageStrategy\Session;

use ChangHorizon\ScopedStorageStrategy\SessionInitializerInterface;

class SessionInitializerWithCookie implements SessionInitializerInterface
{
    public function initialize(?string $sessionId = null): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
