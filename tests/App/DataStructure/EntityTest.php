<?php
declare(strict_types=1);

namespace tests\App\DataStructure;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
	public function testEntity(): void
	{
		$entity = new Entity;

		$this->assertTrue($entity->isLive());
		$this->assertFalse($entity->isDeath());

		$entity->setState(EntityState::DEATH);

		$this->assertFalse($entity->isLive());
		$this->assertTrue($entity->isDeath());
	}
}