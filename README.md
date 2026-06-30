# phpdot/contracts

Shared interfaces for the PHPdot framework

Implementation packages implement these interfaces; consumer packages type-hint against them. An implementation can be swapped without changing any consumer code, and packages never depend on each other's internals. Concrete classes and value objects live in the implementation packages, never here.

## Domains

- **[Logs](https://github.com/phpdot/logs)** — `TracerInterface`, `SpanInterface`, `SpanContextInterface`, `ScopeManagerInterface`, `WriterInterface`, `FormatterInterface`
- **[Session](https://github.com/phpdot/session)** — `SessionInterface`, `SessionHandlerInterface`, `SerializerInterface`
- **[Container](https://github.com/phpdot/container)** — `ContextInterface`, `ContextProviderInterface`, `ContextDestroyInterface`
- **[Server](https://github.com/phpdot/server-swoole)** — `ServerInterface`, `SseHandlerInterface`, `WebSocketHandlerInterface`
- **[Pool](https://github.com/phpdot/pool)** — `ConnectorInterface`
- **[I18n](https://github.com/phpdot/i18n)** — `MessageTranslatorInterface`

## Requirements

- PHP >= 8.4

## License

MIT
