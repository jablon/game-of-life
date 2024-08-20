<?php
declare(strict_types=1);

namespace tests\App\Game\Decision;

use App\Game\Decision\ConditionFactory;
use PHPUnit\Framework\TestCase;

class ConditionFactoryTest extends TestCase
{
	public function testGetInstance(): void
	{
		$instance = ConditionFactory::getInstance();

		$this->assertSame($instance, ConditionFactory::getInstance()); //is same object
	}
}