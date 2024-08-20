<?php
declare(strict_types=1);

namespace App\History;

use App\DataStructure\World;

readonly class Memento
{
	public function __construct(
		private int   $iteration,
		private World $world,
	)
	{
	}

	public function getIteration(): int
	{
		return $this->iteration;
	}

	public function getWorld(): World
	{
		return $this->world;
	}
}