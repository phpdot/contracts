<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

/**
 * Result of a policy decision when the answer needs richer context than
 * a boolean.
 *
 * Use `PolicyResult::deny('reason code or message')` to carry a specific
 * reason that UIs and audit logs can record. For a simple yes, returning
 * `true` from `PolicyInterface::authorize()` is preferred — fewer
 * allocations and clearer intent. Use `PolicyResult::allow()` only when
 * uniform return type is needed (e.g., when other branches of the same
 * method return `PolicyResult::deny(...)`).
 */
final readonly class PolicyResult
{
    private function __construct(
        public bool $allowed,
        public ?string $reason,
    ) {}

    public static function allow(): self
    {
        return new self(true, null);
    }

    public static function deny(?string $reason = null): self
    {
        return new self(false, $reason);
    }
}
