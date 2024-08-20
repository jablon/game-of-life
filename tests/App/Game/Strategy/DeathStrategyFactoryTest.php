<?php
declare(strict_types=1);

namespace tests\App\Game\Strategy;

use App\Game\Strategy\DeathStrategyFactory;
use PHPUnit\Framework\TestCase;

class DeathStrategyFactoryTest extends TestCase
{
	public function testGetInstance(): void
	{
		$instance = DeathStrategyFactory::getInstance();

		$this->assertSame($instance, DeathStrategyFactory::getInstance());
	}
}