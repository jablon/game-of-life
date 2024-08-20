<?php
declare(strict_types=1);

namespace tests\App\History;

use App\DataStructure\World;
use App\History\Caretaker;
use Mockery;
use PHPUnit\Framework\TestCase;

class CaretakerTest extends TestCase
{
	public function testBackup(): void
	{
		$caretaker = new Caretaker;

		$worldMock = Mockery::mock(World::class);

		$caretaker->backup(1, $worldMock);

		$this->assertSame($worldMock, $caretaker->getHistory(1)->getWorld());
		$this->assertNull($caretaker->getHistory(5));
	}
}