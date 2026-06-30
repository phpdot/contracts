<?php

declare(strict_types=1);

/**
 * Span contract — a write-only handle to a single unit of traced work.
 *
 * Callers write attributes, events, status, and correlated log lines onto the
 * span and then end it; only the trace identity is read back, via context().
 * The full span snapshot is read by writers, never through this interface. Every
 * mutator returns the same instance for fluent chaining. Implementations are
 * mutable and bound to a single coroutine for their lifetime.
 *
 * @author Omar Hamdan <omar@phpdot.com>
 * @license MIT
 */

namespace PHPdot\Contracts\Logs;

interface SpanInterface
{
    /**
     * Set a single attribute on the span. `float` is a first-class value type.
     */
    public function setAttribute(string $key, string|int|float|bool $value): static;

    /**
     * Record a timestamped, named event on the span.
     *
     * @param array<string, string|int|float|bool> $attributes
     */
    public function addEvent(string $name, array $attributes = []): static;

    /**
     * Record the explicit outcome of the span.
     *
     * @param string $status      The outcome status (e.g. 'unset', 'ok', 'error').
     * @param string $description Human-readable detail, typically set on errors.
     */
    public function setStatus(string $status, string $description = ''): static;

    /**
     * The trace identity of this span — for propagation and correlation.
     */
    public function context(): SpanContextInterface;

    /**
     * Emit a debug-level log line correlated to this span.
     *
     * Returns a pending handle written when released; call secure() to encrypt
     * the line — $span->debug('...')->secure().
     *
     * @param array<string, mixed> $context
     */
    public function debug(string $message, array $context = []): PendingLogInterface;

    /**
     * Emit an info-level log line correlated to this span.
     *
     * Returns a pending handle written when released; call secure() to encrypt
     * the line — $span->info('...')->secure().
     *
     * @param array<string, mixed> $context
     */
    public function info(string $message, array $context = []): PendingLogInterface;

    /**
     * Emit a warning-level log line correlated to this span.
     *
     * Returns a pending handle written when released; call secure() to encrypt
     * the line — $span->warning('...')->secure().
     *
     * @param array<string, mixed> $context
     */
    public function warning(string $message, array $context = []): PendingLogInterface;

    /**
     * Emit an error-level log line correlated to this span.
     *
     * Returns a pending handle written when released; call secure() to encrypt
     * the line — $span->error('...')->secure().
     *
     * @param array<string, mixed> $context
     */
    public function error(string $message, array $context = []): PendingLogInterface;

    /**
     * End the span: stamp its end time and export it to the writer. Idempotent.
     */
    public function end(): void;
}
