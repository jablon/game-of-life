<?php
declare(strict_types=1);

namespace tests\App\Game\Decision;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\DataStructure\World;
use App\Game\Decision\ThirdCondition;
use App\Game\Strategy\DeathStrategy;
use PHPUnit\Framework\TestCase;

class ThirdConditionTest extends TestCase
{
	private ThirdCondition $handler;

	protected function setUp(): void
	{
		$this->handler = new ThirdCondition;
	}

	public function testTrueCondition(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(0, 0)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(DeathStrategy::class, $strategy);
	}

	public function testFalseCondition(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(0, 0)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity(EntityState::DEATH));

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}

	public function testFalseConditionIsDeathAndNeighborsIsLive(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(0, 0)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}

	public function testFalseConditionIsAllNeighborsIsDeath(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(1, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 2)->setEntity(new Entity(EntityState::DEATH));

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNull($strategy);
	}
}