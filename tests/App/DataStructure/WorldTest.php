<?php
declare(strict_types=1);

namespace tests\App\DataStructure;

use App\DataStructure\Area;
use App\DataStructure\Coordinate;
use App\DataStructure\Entity;
use App\DataStructure\World;
use Mockery;
use PHPUnit\Framework\TestCase;

class WorldTest extends TestCase
{
	public function testIteration(): void
	{
		$size = 4;
		$count = 0;

		$world = new World($size);

		foreach ($world as $area) {
			$this->assertInstanceOf(Area::class, $area);
			++$count;
		}

		$this->assertSame($count, $size * $size);
	}

	public function testFind(): void
	{
		$x = 0;
		$y = 1;

		$world = new World(3);

		$this->assertInstanceOf(Area::class, $world->find($x, $y));

		$entityMock = Mockery::mock(Entity::class);

		$area = $world->find($x, $y);
		$area->setEntity($entityMock);

		$area = $world->find($x, $y);
		$this->assertSame($entityMock, $area->getEntity());

		$area = $world->find(1, 1);
		$this->assertNull($area->getEntity());
	}

	public function testGrid(): void
	{
		$world = new World(3);

		$this->assertNull($world->find(0,0)->getLeft());
		$this->assertNull($world->find(0,0)->getUp());
		$this->assertInstanceOf(Area::class, $world->find(0,0)->getRight());
		$this->assertInstanceOf(Area::class, $world->find(0,0)->getDown());

		$this->assertNull($world->find(1, 0)->getUp());
		$this->assertInstanceOf(Area::class, $world->find(1, 0)->getLeft());
		$this->assertInstanceOf(Area::class, $world->find(1, 0)->getRight());
		$this->assertInstanceOf(Area::class, $world->find(1, 0)->getDown());

		$this->assertNull($world->find(2, 0)->getUp());
		$this->assertInstanceOf(Area::class, $world->find(2, 0)->getLeft());
		$this->assertNull($world->find(2, 0)->getRight());
		$this->assertInstanceOf(Area::class, $world->find(2, 0)->getDown());

		$this->assertInstanceOf(Area::class, $world->find(0, 2)->getUp());
		$this->assertInstanceOf(Area::class, $world->find(0, 2)->getRight());
		$this->assertNull($world->find(0, 2)->getDown());
		$this->assertNull($world->find(0, 2)->getLeft());

		$this->assertNull($world->find(2,2)->getRight());
		$this->assertNull($world->find(2,2)->getDown());
		$this->assertInstanceOf(Area::class, $world->find(2, 2)->getUp());
		$this->assertInstanceOf(Area::class, $world->find(2, 2)->getLeft());

		//ok this is grid 3x3
	}

	public function testKey(): void
	{
		$world = new World(4);

		$coordinate = $world->key();

		$this->assertSame(0, $coordinate->getX());
		$this->assertSame(0, $coordinate->getY());

		/**
		 * @var Coordinate $key
		 * @var Area $item
		 */
		foreach ($world as $key => $item) {
			$this->assertInstanceOf(Coordinate::class, $key);
			$this->assertSame($world->find($key->getX(), $key->getY()), $item);
		}
	}
}