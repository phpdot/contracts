<?php

declare(strict_types=1);

/**
 * Writer contract — the backend export boundary.
 *
 * A writer is a pure export point: it owns no trace identity, no current-span
 * store, and mints no ids — it only decides what to do with an already-scoped,
 * already-correlated record (write it, encrypt it, or discard it). It receives
 * both log records and finished span data as a flat record map. A writer that
 * receives a record marked sensitive that it cannot protect MUST drop or redact
 * it rather than write plaintext (fail-closed). Implementations are stateless
 * singletons.
 *
 * @author Omar Hamdan <omar@phpdot.com>
 * @license MIT
 */

namespace PHPdot\Contracts\Logs;

interface WriterInterface
{
    /**
     * Export a single record — a log line or a finished span snapshot.
     *
     * @param array<string, mixed> $record The record to export.
     */
    public function write(array $record): void;
}
