<?php
declare(strict_types=1);

namespace tests\App\Game\Strategy;

use App\DataStructure\Area;
use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\Game\Strategy\DeathStrategy;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeathStrategyTest extends TestCase
{
	private DeathStrategy $strategy;

	protected function setUp(): void
	{
		$this->strategy = new DeathStrategy;
	}

	public function testDoActionWithNotEmptyArea(): void
	{
		$entityMock = Mockery::mock(Entity::class);
		$entityMock->shouldReceive('setState')
			->with(EntityState::DEATH)
			->once();

		$this->assertSame($entityMock, $this->strategy->doAction($entityMock));
	}
}