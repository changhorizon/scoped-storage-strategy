<?php

declare(strict_types=1);

namespace ChangHorizon\ScopedStorageStrategy;

interface SessionInitializerInterface
{
    public function initialize(?string $sessionId = null): void;
}
