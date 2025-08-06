<?php

namespace Smolblog\TempestPsr\Test;

final readonly class StringBox {
	public function __construct(public string $contents) {}
}