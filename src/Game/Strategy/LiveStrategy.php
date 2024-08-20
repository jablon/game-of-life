<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use App\DataStructure\Entity;
use App\DataStructure\EntityState;

class LiveStrategy implements Strategy
{
	public function doAction(?Entity $entity): ?Entity
	{
		if ($entity === null) {
			$entity = new Entity;
		}
		$entity->setState(EntityState::LIVE);
		return $entity;
	}
}