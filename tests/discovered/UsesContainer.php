<?php

namespace Smolblog\TempestPsr\Test;

use Psr\Container\ContainerInterface;

final readonly class UsesContainer {
	public function __construct(
		public ContainerInterface $container
	) {
	}
}