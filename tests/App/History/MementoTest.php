<?php
declare(strict_types=1);

namespace tests\App\History;

use App\DataStructure\World;
use App\History\Memento;
use Mockery;
use PHPUnit\Framework\TestCase;

class MementoTest extends TestCase
{
	public function testObject(): void
	{
		$iteration = 3;
		$worldMock = Mockery::mock(World::class);

		$memento = new Memento($iteration, $worldMock);

		$this->assertSame($iteration, $memento->getIteration());
		$this->assertSame($worldMock, $memento->getWorld());
	}
}