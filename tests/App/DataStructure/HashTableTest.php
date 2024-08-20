<?php
declare(strict_types=1);

namespace tests\App\DataStructure;

use App\DataStructure\Area;
use App\DataStructure\HashTable;
use Mockery;
use PHPUnit\Framework\TestCase;

class HashTableTest extends TestCase
{
	public function testInsertAndSearch(): void
	{
		$hashTable = new HashTable(4);
		$areaMock = Mockery::mock(Area::class);

		$x = 1;
		$y = 2;

		$hashTable->insert($x, $y, $areaMock);

		$this->assertSame($areaMock, $hashTable->search($x, $y));
		$this->assertNull($hashTable->search(3, 2));
	}
}