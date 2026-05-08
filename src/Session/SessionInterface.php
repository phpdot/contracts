<?php

declare(strict_types=1);

/**
 * Session contract — request-bound read/write API for session state.
 *
 * Provides typed access to session data, flash messages, the CSRF token,
 * and lifecycle operations (regenerate, invalidate). Implementations are
 * mutable and bound to a single request or coroutine for the duration of
 * their lifetime; consumers must not share an instance across requests.
 *
 * @author Omar Hamdan <omar@phpdot.com>
 * @license MIT
 */

namespace PHPdot\Contracts\Session;

interface SessionInterface
{
    /**
     * Get a value from the session.
     */
    public function get(string $key, mixed $default = null): mixed;

    /**
     * Set a value in the session.
     */
    public function set(string $key, mixed $value): void;

    /**
     * Check if a key exists in the session.
     */
    public function has(string $key): bool;

    /**
     * Remove a key from the session.
     */
    public function remove(string $key): void;

    /**
     * Get all session data (excluding internal metadata).
     *
     * @return array<string, mixed>
     */
    public function all(): array;

    /**
     * Clear all session data.
     */
    public function clear(): void;

    /**
     * Flash a key-value pair for the next request only.
     */
    public function flash(string $key, mixed $value): void;

    /**
     * Get a flashed value.
     */
    public function getFlash(string $key, mixed $default = null): mixed;

    /**
     * Check if a flash key exists.
     */
    public function hasFlash(string $key): bool;

    /**
     * Keep all flash data for one more request.
     */
    public function reflash(): void;

    /**
     * Keep specific flash keys for one more request.
     *
     * @param list<string> $keys
     */
    public function keep(array $keys): void;

    /**
     * Get the session ID as a string.
     */
    public function id(): string;

    /**
     * Regenerate the session ID. Optionally destroy the old session.
     */
    public function regenerate(bool $destroy = false): void;

    /**
     * Destroy the session: clear all data and regenerate the ID.
     */
    public function invalidate(): void;

    /**
     * Whether the session has been started (data loaded).
     */
    public function isStarted(): bool;

    /**
     * Get the CSRF token, generating one if it does not exist.
     */
    public function token(): string;

    /**
     * Generate a new CSRF token, replacing the existing one.
     */
    public function regenerateToken(): string;

    /**
     * Unix timestamp when the session was first created.
     */
    public function createdAt(): int;

    /**
     * Unix timestamp of the last activity on this session.
     */
    public function lastActivity(): int;
}
