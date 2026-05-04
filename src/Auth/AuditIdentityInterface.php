<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * Identities that supply a minimal payload for audit logging.
 *
 * The audit identity is intentionally narrower than the full identity —
 * it carries only what is safe to log: no sensitive fields, no profile
 * data, no full credential references. Logging frameworks consume this
 * via the optional capability check `instanceof AuditIdentityInterface`.
 *
 * Identities that don't implement this interface still get logged; the
 * framework falls back to recording only the type name and identifier.
 */
interface AuditIdentityInterface
{
    /**
     * Minimal logging payload. Keys are app-defined; conventional fields
     * are 'type', 'id', 'ip', and a few non-sensitive context values.
     *
     * @return array<string, scalar|null>
     */
    public function getAuditIdentity(): array;
}
