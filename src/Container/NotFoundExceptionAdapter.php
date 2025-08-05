<?php

namespace Smolblog\TempestPsr\Container;

use Exception;
use Psr\Container\NotFoundExceptionInterface;
use Tempest\Container\Exceptions\DependencyCouldNotBeInstantiated;

class NotFoundExceptionAdapter extends Exception implements NotFoundExceptionInterface {
	public function __construct(DependencyCouldNotBeInstantiated $original) {
		parent::__construct(
			message: $original->getMessage(),
			previous: $original,
		);
	}
}