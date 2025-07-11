<?php

declare(strict_types=1);

namespace Tempest\Cache;

use Exception;

final class CacheCouldNotBeCleared extends Exception implements CacheException
{
}
