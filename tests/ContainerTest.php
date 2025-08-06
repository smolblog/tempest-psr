<?php

namespace Smolblog\TempestPsr\Container;

use PHPUnit\Framework\Attributes\TestDox;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Smolblog\TempestPsr\Test\EmptyBox;
use Smolblog\TempestPsr\Test\StringBox;
use Smolblog\TempestPsr\Test\UsesContainer;
use Tempest\Discovery\DiscoveryLocation;
use Tempest\Framework\Testing\IntegrationTest;

final class ContainerTest extends IntegrationTest {
	protected string $root = __DIR__ . '/../';

	protected function setUp(): void {
		$this->discoveryLocations = [
			new DiscoveryLocation('Smolblog\\TempestPsr\\Test', __DIR__ . '/discovered'),
		];

		parent::setUp();
	}

	#[TestDox('ContainerAdapter will be given in place of ContainerInterface by Container')]
	public function testContainerAdapterInit() {
		$actual = $this->container->get(ContainerInterface::class);

		$this->assertInstanceOf(ContainerAdapter::class, $actual);
	}

	#[TestDox('ContainerAdapter will be given in place of ContainerInterface as a dependency')]
	public function testContainerAdapterDependency() {
		$actual = $this->container->get(UsesContainer::class);

		$this->assertInstanceOf(UsesContainer::class, $actual);
		$this->assertInstanceOf(ContainerAdapter::class, $actual->container);
	}

	#[TestDox('ContainerAdapter will function as a PSR-11 container')]
	public function testContainerAdapterFunctionality() {
		$actual = $this->container->get(ContainerInterface::class);
		$this->container->register(StringBox::class, fn($c) => new StringBox('Prospero'));

		$this->assertInstanceOf(ContainerAdapter::class, $actual);

		$this->assertTrue($actual->has(StringBox::class));
		$this->assertTrue($actual->has(EmptyBox::class));
		$this->assertFalse($actual->has('Not\\A\\Real\\Class'));

		$this->assertInstanceOf(EmptyBox::class, $actual->get(EmptyBox::class));
	}

	#[TestDox('ContainerAdapter will throw a ContainerExceptionInterface if an exception is thrown.')]
	public function testContainerAdapterNotFound() {
		$actual = $this->container->get(ContainerInterface::class);

		$this->expectException(ContainerExceptionInterface::class);
		$actual->get('Not\\A\\Real\\Class');
	}
}