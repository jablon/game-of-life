<?php
declare(strict_types=1);

namespace App\DataStructure;

class WorldDirector
{
	private ?WorldBuilder $builder = null;

	public function setBuilder(WorldBuilder $builder): void
	{
		$this->builder = $builder;
	}

	public function create(): World
	{
		$world = new World($this->builder->getSize());

		foreach ($this->builder->getCoordinates() as $coordinate) {
			$area = $world->findByCoordinate($coordinate);

			$entity = new Entity;
			$entity->setState(EntityState::LIVE);

			$area->setEntity($entity);
		}

		return $world;
	}
}