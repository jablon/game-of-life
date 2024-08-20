<?php
declare(strict_types=1);

namespace tests\App\Game\Decision;

use App\DataStructure\Entity;
use App\DataStructure\World;
use App\Game\Decision\SecondCondition;
use App\Game\Strategy\LiveStrategy;
use PHPUnit\Framework\TestCase;

class SecondConditionTest extends TestCase
{
	private SecondCondition $handler;

	protected function setUp(): void
	{
		$this->handler = new SecondCondition;
	}

	public function testTrueConditionTwoLive(): void
	{
		$world = new World(4);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(LiveStrategy::class, $strategy);
	}

	public function testTrueConditionThreeLive(): void
	{
		$world = new World(4);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(LiveStrategy::class, $strategy);
	}

	public function testFalseConditionOneLive(): void
	{
		$world = new World(4);
		$world->find(1, 0)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}

	public function testFalseCondtionFourLive(): void
	{
		$world = new World(4);
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);
		$world->find(0, 1)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}
}