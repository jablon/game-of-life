<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;

class DeathStrategy implements Strategy
{

	public function doAction(?Entity $entity): ?Entity
	{
		$entity?->setState(EntityState::DEATH);
		return $entity;
	}
}