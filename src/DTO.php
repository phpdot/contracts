<?php

declare(strict_types=1);

namespace PHPdot\Contracts;

/**
 * Marker interface for Data Transfer Objects passed across framework
 * boundaries.
 *
 * DTOs are immutable value objects used as inputs and outputs of policies,
 * events, queue jobs, and other framework integration points. Implementing
 * this interface tags a class as "safe to pass across boundaries": no
 * service references, no mutable state, predictable shape.
 *
 * The interface carries no methods. The recommended shape is
 * `final readonly class MyDto implements DTO`.
 */
interface DTO {}
