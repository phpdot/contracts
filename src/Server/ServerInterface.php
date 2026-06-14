<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Server;

use Psr\Http\Server\RequestHandlerInterface;

/**
 * Runs a PSR-15 request handler under a server runtime.
 *
 * The single entry point shared by every PHPdot server adapter — the classic
 * SAPI runtime (one request per process) and the Swoole server (a long-running
 * event loop). An implementation captures the request from its environment,
 * passes it to the handler, and emits the response. Runtime-specific options
 * (host, port, …) are added as optional parameters by the implementation.
 */
interface ServerInterface
{
    /**
     * Serve requests with the given PSR-15 handler.
     *
     * @param RequestHandlerInterface $handler The application's PSR-15 handler
     */
    public function serve(RequestHandlerInterface $handler): void;
}
