<?php
declare(strict_types=1);

namespace tests\App\Game\Strategy;

use App\Game\Strategy\ContextFactory;
use PHPUnit\Framework\TestCase;

class ContextFactoryTest extends TestCase
{
	public function testGetInstance(): void
	{
		$instance = ContextFactory::getInstance();

		$this->assertSame($instance, ContextFactory::getInstance());
	}
}