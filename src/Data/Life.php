<?php
declare(strict_types=1);

namespace App\Data;

class Life
{
	private array $organisms = [];

	public function __construct(
		private readonly World $world,
	)
	{
	}

	public function getWorld(): World
	{
		return $this->world;
	}

	public function getOrganisms(): array
	{
		return $this->organisms;
	}

	public function addOrganism(Organism $organism): void
	{
		$this->organisms[] = $organism;
	}
}