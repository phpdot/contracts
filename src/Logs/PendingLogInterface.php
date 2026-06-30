<?php

declare(strict_types=1);

/**
 * Pending Log handle.
 *
 * The deferred result of a tracer or span log call. The record is built with the
 * current trace correlation at the call site and written when this handle is
 * released — at the end of the statement for the common one-line form. Calling
 * secure() before that flags the record so a backend encrypts it (message AND
 * context, fail-closed) instead of writing it in plaintext:
 *
 *     $tracer->info('Password reset for ' . $email)->secure();
 *
 * A plain `$tracer->info(...);` simply writes the line and discards the handle.
 *
 * @author Omar Hamdan <omar@phpdot.com>
 * @license MIT
 */

namespace PHPdot\Contracts\Logs;

interface PendingLogInterface
{
    /**
     * Mark this log line sensitive: the backend encrypts its message and context
     * together (fail-closed — dropped, never plaintext, if it cannot be protected).
     * Call it on the same statement as the log call, before the handle is released:
     * $tracer->error('...')->secure().
     */
    public function secure(): static;
}
