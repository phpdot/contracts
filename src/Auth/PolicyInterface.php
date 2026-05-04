<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

use PHPdot\Contracts\DTO;

/**
 * A policy class makes a per-resource authorization decision. Used for
 * fine-grained checks beyond what flat RBAC permissions express:
 * "can THIS user edit THIS specific post?", "can THIS api client
 * withdraw from THIS account?".
 *
 * Policies receive an identity and an optional resource DTO. They return
 * either:
 *
 *   - `true` to allow
 *   - `false` to deny without explanation
 *   - a `PolicyResult` carrying a specific reason for the deny — useful
 *     when the UI needs to show a meaningful error rather than a generic
 *     403, or when audit logs need to record why authorization failed
 *
 * Policies are pure decision functions. They MAY consult RBAC permissions
 * via the framework's Authorizer (typically via DI), MAY read resource
 * state, but MUST NOT mutate state. Mutation belongs in services.
 */
interface PolicyInterface
{
    public function authorize(
        AuthIdentityInterface $identity,
        ?DTO $resource = null,
    ): bool|PolicyResult;
}
