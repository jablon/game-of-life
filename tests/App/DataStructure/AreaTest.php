<?php
declare(strict_types=1);

namespace tests\App\DataStructure;

use App\DataStructure\Area;
use PHPUnit\Framework\TestCase;

class AreaTest extends TestCase
{
	public function testEmptyArea(): void
	{
		$area = new Area(0, 0);
		$this->assertNull($area->getUp());
		$this->assertNull($area->getDown());
		$this->assertNull($area->getLeft());
		$this->assertNull($area->getRight());
	}

	public function testUp(): void
	{
		$area = new Area(0, 0);
		$upArea = new Area(0, 0);

		$area->setUp($upArea);

		$this->assertSame($area->getUp(), $upArea);
	}

	public function testDown(): void
	{
		$area = new Area(0, 0);
		$downArea = new Area(0, 0);

		$area->setDown($downArea);

		$this->assertSame($area->getDown(), $downArea);
	}

	public function testLeft(): void
	{
		$area = new Area(0, 0);
		$leftArea = new Area(0, 0);

		$area->setLeft($leftArea);

		$this->assertSame($area->getLeft(), $leftArea);
	}

	public function testRight(): void
	{
		$area = new Area(0, 0);
		$rightArea = new Area(0, 0);

		$area->setRight($rightArea);

		$this->assertSame($area->getRight(), $rightArea);
	}
}