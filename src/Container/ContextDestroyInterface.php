<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Container;

use Closure;

/**
 * A context that supports per-context destroy callbacks.
 *
 * Implementations register callbacks via `onDestroy()` and invoke them when
 * the current context ends — end of coroutine in Swoole, end of process or
 * explicit `reset()` in FPM/CLI.
 *
 * Optional capability extending `ContextInterface`. The DI container
 * feature-detects with `instanceof` and skips destroy hooks when the active
 * context does not implement this interface.
 *
 * Implementations SHOULD invoke callbacks in LIFO order (last registered
 * fires first), matching Swoole's `Coroutine::defer` semantics.
 *
 * Implementations MUST NOT propagate exceptions thrown by callbacks —
 * destroy is best-effort cleanup.
 */
interface ContextDestroyInterface
{
    /**
     * Register a callback to run when the current context is destroyed.
     *
     * @param Closure(): void $callback
     */
    public function onDestroy(Closure $callback): void;
}
