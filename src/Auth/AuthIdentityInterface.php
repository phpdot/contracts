<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * The contract every identity (User, Guest, ApiClient, CLI process, Service,
 * Webhook, Bot, IoT device, ...) implements.
 *
 * Intentionally minimal: an authentication flag, a stable identifier within
 * the identity's domain, and a string label for logs/audit. Authentication
 * and authorization concerns layer on top of this interface — they are NOT
 * inferred from the identity's type.
 *
 * Type polymorphism is via class identity (`instanceof`), not via an enum
 * or registry. New identity types are added by implementing this interface
 * in a new class.
 */
interface AuthIdentityInterface
{
    /**
     * True if and only if this specific identity instance has been
     * authenticated by a credential provider.
     *
     * Type alone never grants authentication. A `CliIdentity` is not
     * authenticated unless an authentication step (token, certificate,
     * shared secret) verified it. A `UserIdentity` constructed from a
     * session record is authenticated; one constructed from a guest
     * fallback is not.
     */
    public function authenticated(): bool;

    /**
     * Stable identifier within the identity's domain. Users have a user_id,
     * api clients have an api_client_id, services have a service_id,
     * webhooks may use a hash of the verified payload.
     *
     * The framework treats this as an opaque value passed through to
     * stores and audit logs.
     */
    public function getIdentifier(): string|int;

    /**
     * Stable string label for logs, audit rows, telemetry tags, and JSON
     * serialization. Apps choose their own values: 'user', 'api', 'guest',
     * 'cli', 'service', 'webhook', 'bot', 'iot_device', etc.
     *
     * The label is used as a discriminator string only; it carries no
     * security or authorization semantics.
     */
    public function getTypeName(): string;
}
