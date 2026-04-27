<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Container;

/**
 * Returns the active `ContextInterface` for the current unit of execution.
 *
 *  - FPM:    the process (only one context ever exists)
 *  - Swoole: the current coroutine
 *  - Fiber:  the current fiber
 *
 * Implementations live in `phpdot/container` (Array, Callback) and
 * `phpdot/container-swoole` (Swoole).
 */
interface ContextProviderInterface
{
    public function getContext(): ContextInterface;
}
