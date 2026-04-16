<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Server;

use Closure;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Handles Server-Sent Events (SSE) requests.
 *
 * Implemented by routers or handlers that support SSE dispatch.
 * Server implementations detect this interface and delegate SSE requests
 * before falling through to normal HTTP handling.
 */
interface SseHandlerInterface
{
    /**
     * Handle an SSE request.
     *
     * Returns true if a route matched and the stream was handled,
     * false to fall through to normal HTTP dispatch.
     *
     * @param ServerRequestInterface $request The incoming request
     * @param Closure(string): bool $write Write SSE data to the stream (returns false on client disconnect)
     * @param Closure(): void $close Close the stream
     */
    public function handleSse(
        ServerRequestInterface $request,
        Closure $write,
        Closure $close,
    ): bool;
}
