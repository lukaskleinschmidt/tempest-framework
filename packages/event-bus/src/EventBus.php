<?php

declare(strict_types=1);

namespace Tempest\EventBus;

use Closure;

interface EventBus
{
    public function dispatch(string|object $event): void;

    public function listen(Closure $handler, ?string $event = null): void;
}
