<?php
declare(strict_types=1);

namespace tests\App\Game\Decision;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\DataStructure\World;
use App\Game\Decision\FourthCondition;
use App\Game\Strategy\LiveStrategy;
use PHPUnit\Framework\TestCase;

class FourthConditionTest extends TestCase
{
	private FourthCondition $handler;

	protected function setUp(): void
	{
		$this->handler = new FourthCondition;
	}

	public function testTrueCondition(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(LiveStrategy::class, $strategy);
	}

	public function testFalseCondition(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}

	public function testOneNeighbourIsDeath(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}
}