<?php
declare(strict_types=1);

namespace tests\App\Game\Decision;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\DataStructure\World;
use App\Game\Decision\Helper;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
	public function testLiveCounterTheyAreAllDead(): void
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

		$this->assertSame(0, Helper::liveCounter($world->find(1, 1)));
	}

	public function testLiveCounterNeighborsDoNotExist(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);

		$this->assertSame(0, Helper::liveCounter($world->find(1, 1)));
	}

	public function testLiveCounterOnlyOneLives(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity);
		$world->find(1,0)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 1)->setEntity(new Entity(EntityState::DEATH));
		$world->find(2, 2)->setEntity(new Entity(EntityState::DEATH));

		$this->assertSame(1, Helper::liveCounter($world->find(1, 1)));
	}

	public function testLiveCounterOnlyOneLivesAndOneAreaIsEmpty(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity(EntityState::DEATH));
		$world->find(1, 0)->setEntity(new Entity);

		$this->assertSame(1, Helper::liveCounter($world->find(1, 1)));
	}

	public function testLiveCounterAllLives(): void
	{
		$world = new World(4);
		$world->find(1, 1)->setEntity(new Entity);
		$world->find(1, 0)->setEntity(new Entity);
		$world->find(1, 2)->setEntity(new Entity);
		$world->find(0, 1)->setEntity(new Entity);
		$world->find(2, 1)->setEntity(new Entity);
		$world->find(0, 0)->setEntity(new Entity);
		$world->find(2, 0)->setEntity(new Entity);
		$world->find(2, 2)->setEntity(new Entity);
		$world->find(0, 2)->setEntity(new Entity);

		$this->assertSame(8, Helper::liveCounter($world->find(1, 1)));
	}
}