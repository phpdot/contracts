<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * Per-request authentication state for one credential type.
 *
 * Implementations include SessionGuard (cookie-based web auth), TokenGuard
 * (Authorization: Bearer ...), JwtGuard (stateless tokens), etc. Each
 * guard encapsulates the lookup logic for its credential type. Multiple
 * guards may be active simultaneously; the IdentityResolver chain queries
 * them in priority order.
 */
interface AuthGuardInterface
{
    /**
     * Whether the request has an authenticated identity through this guard.
     */
    public function check(): bool;

    /**
     * The current authenticated identity, or null if none.
     */
    public function user(): ?AuthIdentityInterface;

    /**
     * Identifier of the current authenticated identity, or null if none.
     * Convenience over `user()?->getIdentifier()`.
     */
    public function id(): string|int|null;

    /**
     * Verify credentials and, on success, establish authentication state
     * within this guard.
     *
     * @param array<string, mixed> $credentials
     */
    public function attempt(array $credentials): bool;

    /**
     * Establish authentication state for an already-verified identity.
     * Typically called by services that did their own credential check.
     */
    public function login(AuthIdentityInterface $identity): void;

    /**
     * Tear down authentication state in this guard.
     */
    public function logout(): void;
}
