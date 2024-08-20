<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use App\DataStructure\Area;
use App\DataStructure\Entity;

class Context
{
	public function __construct(
		private ?Strategy $strategy = null,
	)
	{
	}

	public function setStrategy(?Strategy $strategy): void
	{
		$this->strategy = $strategy;
	}

	public function doAction(Area $area): ?Entity
	{
		return $this->strategy?->doAction(!$area->isEmpty() ? clone $area->getEntity() : null);
	}
}