<?php
declare(strict_types=1);

namespace tests\App\Game\Decision;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\DataStructure\World;
use App\Game\Decision\FirstCondition;
use App\Game\Strategy\DeathStrategy;
use PHPUnit\Framework\TestCase;

class FirstConditionTest extends TestCase
{
	private FirstCondition $handler;

	protected function setUp(): void
	{
		$this->handler = new FirstCondition;
	}

	public function testTrueCondition(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 0)->setEntity(new Entity(EntityState::DEATH));

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(DeathStrategy::class, $strategy);
	}

	public function testFalseConditionAllIsLive(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(2, 0)->setEntity(new Entity);
		$this->assertNull($this->handler->handle($world->find(1, 1)));
	}

	public function testTrueConditionAllIsDeath(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 0)->setEntity(new Entity(EntityState::DEATH));

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(DeathStrategy::class, $strategy);
	}

	public function testTrueConditionIsSingle(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(DeathStrategy::class, $strategy);
	}

	public function testFalseConditionIsSingleAndDeath(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity(EntityState::DEATH));
		$this->assertNull($this->handler->handle($world->find(1, 1)));
	}

	public function testFalseConditionAllNeighborsIsDeath(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(1, 2)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 1)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 1)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 2)->setEntity(new Entity(EntityState::DEATH));
		$world->find(0, 2)->setEntity(new Entity(EntityState::DEATH));

		$strategy = $this->handler->handle($world->find(1, 1));

		$this->assertNotNull($strategy);
		$this->assertInstanceOf(DeathStrategy::class, $strategy);
	}
}