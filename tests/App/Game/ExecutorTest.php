<?php
declare(strict_types=1);

namespace tests\App\Game;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use App\DataStructure\World;
use App\Game\Decision\Handler;
use App\Game\Executor;
use App\Game\Strategy\Context;
use App\Game\Strategy\DeathStrategy;
use App\Game\Strategy\LiveStrategy;
use Mockery;
use PHPUnit\Framework\TestCase;

class ExecutorTest extends TestCase
{
	private Executor $executor;

	protected function setUp(): void
	{
		$handlerMock = Mockery::mock(Handler::class);

		$handlerMock->shouldReceive('handle')
			->andReturn(new LiveStrategy);

		$context = new Context(new DeathStrategy); //default set is death

		$this->executor = new Executor($handlerMock, $context);
	}

	public function testExecutor(): void
	{
		$x = 1;
		$y = 1;

		$wold = new World(4);

		$entity = new Entity;
		$entity->setState(EntityState::DEATH);
		$wold->find($x, $y)->setEntity($entity);

		$newWorld = $this->executor->execute($wold);

		$this->assertNotSame($wold, $newWorld);

		$this->assertTrue($newWorld->find($x, $y)->getEntity()->isLive());
	}
}