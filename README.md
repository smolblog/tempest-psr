# Tempest PSR Adapters

Initializers and adapters for using Tempest's infrastructure with PSR-compatible libraries.

## But why?

Tempest's design doesn't map fully to the PSR interfaces for one reason or another. But if you're using a library
that's expecting some PSR-compatible object, things can get _close enough_ that the library should work.

This library does the work of adding adapter classes that

1. Will fulfill any dependencies on PSR interfaces through Tempest's Container, and
2. Provide a rough translation between general PSR expectations and Tempest's actual implementation.

## Current Implementations

### PSR-11 Dependency Injection Container

Maps `Tempest\Container\Container` to `Psr\Container\ContainerInterface`.

#### Known Issues

- Currently re-throws all `Throwable` objects as `ContainerExceptionInterface`. Will not throw a
  `NotFoundExceptionInterface` even if that is the error because... I haven't implemented that yet.

## Meta

Written by Evan Hildreth for the Smolblog project. Licensed under the MIT license to align with Tempest. All your base
are belong to us.