<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * Verifies a single type of credential — password, API key, JWT, OAuth2
 * callback, WebAuthn assertion, TOTP code, SAML response, etc.
 *
 * Multiple providers may be registered. The login flow iterates and asks
 * each via `supports()` before delegating verification. Provider order
 * follows DI registration order.
 *
 * Providers MUST treat the credentials array as untrusted input. They
 * MUST use constant-time comparison for any secret material to avoid
 * timing-based information disclosure.
 */
interface CredentialProviderInterface
{
    /**
     * Whether this provider can verify the given credentials shape.
     *
     * @param array<string, mixed> $credentials
     */
    public function supports(array $credentials): bool;

    /**
     * Verify the credentials against the identity. Returns true on
     * successful verification, false otherwise.
     *
     * Implementations MUST NOT throw on bad credentials — return false.
     * Throw only on infrastructure failure (DB unreachable, etc.).
     *
     * @param array<string, mixed> $credentials
     */
    public function verify(AuthIdentityInterface $identity, array $credentials): bool;
}
