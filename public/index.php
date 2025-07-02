<?php

declare(strict_types=1);

use Tempest\Discovery\DiscoveryLocation;
use Tempest\Router\HttpApplication;

require_once __DIR__ . '/../vendor/autoload.php';

class Debug
{
    public static array $logs = [];

    public static function debug(string $name, Closure $callback): mixed
    {
        $start = hrtime(true);
        $value = $callback();
        $end   = hrtime(true);

        $duration = ($end - $start) / 1_000_000;

        self::$logs[$name] = $duration . 'ms';

        return $value;
    }
}

function debug(string $name, Closure $callback): mixed
{
    return Debug::debug($name, $callback);
}

try {
    HttpApplication::boot(__DIR__ . '/../', discoveryLocations: [
        // new DiscoveryLocation('Tests\\Tempest\\Fixtures\\', __DIR__ . '/../tests/Fixtures/'),
    ])->run();
} catch (\Throwable $th) {
    //throw $th;
}

Debug::$logs['tempest'] = (hrtime(true) - TEMPEST_START) / 1_000_000 . 'ms';

dd(Debug::$logs);

exit();
