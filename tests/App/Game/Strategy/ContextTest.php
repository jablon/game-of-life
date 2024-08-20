<?php
declare(strict_types=1);

namespace tests\App\Game\Strategy;

use App\DataStructure\Area;
use App\DataStructure\Entity;
use App\Game\Strategy\Context;
use App\Game\Strategy\Strategy;
use Mockery;
use PHPUnit\Framework\TestCase;

class ContextTest extends TestCase
{
	public function testSetStrategy(): void
	{
		$context = new Context;

		$strategy = Mockery::mock(Strategy::class);
		$areaMock = Mockery::mock(Area::class);

		$entityMock = Mockery::mock(Entity::class);
		$areaMock->shouldReceive('getEntity')
			->andReturn($entityMock)
			->once();

		$areaMock->shouldReceive('isEmpty')
			->andReturn(false)
			->once();

		$strategy->shouldReceive('doAction')
			->andReturn(Mockery::mock(Entity::class));

		$context->setStrategy($strategy);
		$entity = $context->doAction($areaMock);

		$this->assertInstanceOf(Entity::class, $entity);
	}

	public function testDefaultContext(): void
	{
		$strategy = Mockery::mock(Strategy::class);
		$areaMock = Mockery::mock(Area::class);
		$entityMock = Mockery::mock(Entity::class);

		$areaMock->shouldReceive('getEntity')
			->andReturn($entityMock)
			->once();

		$areaMock->shouldReceive('isEmpty')
			->andReturn(false)
			->once();

		$strategy->shouldReceive('doAction')
			->andReturn(Mockery::mock(Entity::class));

		$context = new Context($strategy);
		$entity = $context->doAction($areaMock);

		$this->assertInstanceOf(Entity::class, $entity);
	}
}