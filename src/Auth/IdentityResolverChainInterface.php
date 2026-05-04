<?php

declare(strict_types=1);

namespace PHPdot\Contracts\Auth;

use Psr\Http\Message\ServerRequestInterface;

/**
 * One link in the chain of identity resolvers. The framework runs registered
 * resolvers in priority order; the first that returns a non-null identity
 * wins. A built-in fallback resolver always returns a Guest identity, so
 * resolution never fails — every request has an identity.
 *
 * Built-in framework links resolve CLI context, Bearer tokens, session
 * cookies, and the Guest fallback. Apps register custom resolvers for
 * new identity types (webhook signatures, mTLS, custom API keys, etc.)
 * by implementing this interface and tagging the service in DI.
 */
interface IdentityResolverChainInterface
{
    /**
     * Try to resolve the identity from the request. Return null to defer
     * to the next resolver in the chain.
     */
    public function resolve(ServerRequestInterface $request): ?AuthIdentityInterface;

    /**
     * Higher priority runs first. Conventional values:
     *
     *   1000  CLI context
     *    900  Custom (webhook signatures, mTLS, etc.)
     *    800  Bearer tokens (API keys, personal access tokens)
     *    600  Session cookies (web auth)
     *     -1  Guest fallback (always returns)
     */
    public function priority(): int;
}
