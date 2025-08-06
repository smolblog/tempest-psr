<?php

namespace Smolblog\TempestPsr\Container;

use Psr\Container\ContainerInterface;
use Tempest\Container\Autowire;
use Tempest\Container\Container;
use Tempest\Container\Exceptions\ContainerException;
use Tempest\Container\Exceptions\DependencyCouldNotBeInstantiated;
use Throwable;

#[Autowire]
class ContainerAdapter implements ContainerInterface {
	public function __construct(private Container $container) {}

	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @return bool
	 */
	public function has(string $id): bool {
		// Account for autowired classes without a formal definition.
		return $this->container->has($id) || class_exists($id);
	}

	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 *
	 * @throws ContainerExceptionInterface Error while retrieving the entry.
	 *
	 * @return mixed Entry.
	 */
	public function get(string $id): mixed {
		try {
			return $this->container->get($id);
		} catch (Throwable $e) {
			throw new ContainerExceptionAdapter($e);
		}
	}
}