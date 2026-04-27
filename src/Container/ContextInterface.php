<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Container;

/**
 * The active execution context — a typed key/value store of object instances
 * scoped to the current unit of execution (process, coroutine, or fiber).
 *
 * Used by the DI container's `Scoped` lifecycle to isolate per-execution
 * service instances. Implementations live in concrete container packages:
 * `phpdot/container` (Array/Callback) and `phpdot/container-swoole` (Swoole).
 */
interface ContextInterface
{
    public function has(string $id): bool;

    public function get(string $id): object|null;

    public function set(string $id, object $instance): void;

    public function unset(string $id): void;

    public function reset(): void;
}
