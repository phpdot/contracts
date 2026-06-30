<?php

declare(strict_types=1);

/**
 * Formatter contract — renders a record into its serialized output form.
 *
 * A formatter turns a flat record map — a log line or a finished span snapshot —
 * into the string a sink writes (e.g. a line of JSON or a text line).
 * Implementations are stateless singletons and must not mutate the record.
 *
 * @author Omar Hamdan <omar@phpdot.com>
 * @license MIT
 */

namespace PHPdot\Contracts\Logs;

interface FormatterInterface
{
    /**
     * Render a record to its serialized string form.
     *
     * @param array<string, mixed> $record The record to format.
     */
    public function format(array $record): string;
}
