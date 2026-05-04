<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * Marker interface grouping identity storage contracts.
 *
 * Each identity type has its own type-specific store interface (defined
 * by the framework or by the application). Stores share this marker for
 * tooling, DI introspection, and ServiceProvider grouping. Methods are
 * intentionally NOT declared here, because lookup patterns differ across
 * identity types:
 *
 *   - users are looked up by email/username/phone
 *   - api clients by hashed token
 *   - service identities by certificate fingerprint or shared secret
 *   - webhooks by signed payload (no store needed; ephemeral)
 *
 * The framework defines `UserStoreInterface`, `ApiClientStoreInterface`,
 * etc. (in `phpdot/iam`). Apps add new identity types by defining their
 * own type-specific store interfaces extending this marker.
 */
interface IdentityStoreInterface {}
