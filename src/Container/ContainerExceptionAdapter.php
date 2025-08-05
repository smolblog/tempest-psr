<?php

namespace Smolblog\TempestPsr\Container;

use Exception;
use Throwable;
use Psr\Container\ContainerExceptionInterface;

class ContainerExceptionAdapter extends Exception implements ContainerExceptionInterface {
	public function __construct($original) {
		parent::__construct(
			message: $original->getMessage(),
			previous: $original,
		);
	}
}