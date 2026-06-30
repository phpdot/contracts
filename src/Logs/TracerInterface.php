<?php

declare(strict_types=1);

/**
 * Tracer contract — the single observability entry point every package holds.
 *
 * Stateless by design: it reads the "current" span from the per-coroutine scope
 * on every call, so one instance is safe as a shared singleton under Swoole.
 * Starts child spans, exposes the active span and its identity for propagation,
 * and emits correlated log lines against the current span.
 *
 * @author Omar Hamdan <omar@phpdot.com>
 * @license MIT
 */

namespace PHPdot\Contracts\Logs;

interface TracerInterface
{
    /**
     * A tracer scoped to a named channel: its log lines and spans are tagged with
     * the channel so a backend can route them to their own stream (tracelog writes
     * `{channel}.log`). The trace identity is unchanged — lines on different
     * channels in the same request still share one trace_id.
     *
     * @param string $name The channel name (e.g. 'http', 'auth', 'db').
     */
    public function channel(string $name): self;

    /**
     * Start a child of current() and activate it as the current span until it ends.
     *
     * @param string $name The span name.
     * @param string $kind The span role (e.g. 'internal', 'server', 'client', 'producer', 'consumer').
     */
    public function span(string $name, string $kind = 'internal'): SpanInterface;

    /**
     * The active span — NEVER null. Returns a no-op span when no frame is active
     * (e.g. off-kernel coroutines), so callers never branch on null.
     */
    public function current(): SpanInterface;

    /**
     * Identity of the current span — for propagation. Equivalent to current()->context().
     */
    public function context(): SpanContextInterface;

    /**
     * Run a callback inside a fresh child span, guaranteeing the span is always ended.
     *
     * Starts a child of current() and activates it, runs the callback, and ends the span
     * afterwards no matter how the callback returns. If the callback throws, the span is
     * marked with an 'error' status, the exception is recorded, the span is ended, and the
     * exception is re-thrown. This is the contract-level guarantee that no span is ever
     * orphaned. Returns the callback's return value unchanged.
     *
     * @template T
     * @param string $name The span name.
     * @param string $kind The span role (e.g. 'internal', 'server', 'client', 'producer', 'consumer').
     * @param callable(SpanInterface): T $callback Receives the active span; its return value is returned.
     * @return T
     */
    public function trace(string $name, string $kind, callable $callback): mixed;

    /**
     * Emit a debug-level log line correlated to the current span.
     *
     * @param array<string, mixed> $context
     */
    public function debug(string $message, array $context = []): void;

    /**
     * Emit an info-level log line correlated to the current span.
     *
     * @param array<string, mixed> $context
     */
    public function info(string $message, array $context = []): void;

    /**
     * Emit a warning-level log line correlated to the current span.
     *
     * @param array<string, mixed> $context
     */
    public function warning(string $message, array $context = []): void;

    /**
     * Emit an error-level log line correlated to the current span.
     *
     * @param array<string, mixed> $context
     */
    public function error(string $message, array $context = []): void;
}
