<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * Marks an identity that participates in a multi-tenant context.
 *
 * The framework's authorization, query scoping, and audit logging detect
 * this interface via `instanceof` and route their behavior accordingly:
 *
 *   - permission checks scope to membership_id rather than user_id
 *   - tenant-scoped queries filter by tenant_id
 *   - audit rows include tenant context
 *   - personal access tokens (when the package is installed) attach to
 *     membership_id rather than user_id
 *
 * Single-tenant apps' identities never implement this interface.
 * Multi-tenant apps' user identities implement it; their api client and
 * service identities may or may not, depending on whether tokens are
 * tenant-scoped.
 */
interface TenantAwareIdentity extends AuthIdentityInterface
{
    /**
     * The tenant this identity is currently acting in.
     */
    public function getTenantId(): string|int;

    /**
     * The membership linking this identity to the tenant.
     *
     * Returns null when the identity is tenant-scoped without a per-membership
     * record — for example, a service identity authorized to act in a specific
     * tenant via service credentials rather than user membership.
     */
    public function getMembershipId(): string|int|null;
}
