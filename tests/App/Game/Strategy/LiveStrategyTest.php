<?php
declare(strict_types=1);

namespace tests\App\Game\Strategy;

use App\DataStructure\Area;
use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\Game\Strategy\LiveStrategy;
use Mockery;
use PHPUnit\Framework\TestCase;

class LiveStrategyTest extends TestCase
{
	private LiveStrategy $strategy;

	protected function setUp(): void
	{
		$this->strategy = new LiveStrategy;
	}

	public function testDoActionWithNotEmptyArea(): void
	{
		$entityMock = Mockery::mock(Entity::class);
		$entityMock->shouldReceive('setState')
			->with(EntityState::LIVE)
			->once();

		$entity = $this->strategy->doAction($entityMock);

		$this->assertSame($entityMock, $entity);
		$this->addToAssertionCount(1);
	}
}