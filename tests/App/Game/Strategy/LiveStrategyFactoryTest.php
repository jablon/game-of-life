<?php
declare(strict_types=1);

namespace tests\App\Game\Strategy;

use App\Game\Strategy\LiveStrategyFactory;
use PHPUnit\Framework\TestCase;

class LiveStrategyFactoryTest extends TestCase
{
	public function testGetInstance(): void
	{
		$instance = LiveStrategyFactory::getInstance();

		$this->assertSame($instance, LiveStrategyFactory::getInstance());
	}
}