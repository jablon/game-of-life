<?php
declare(strict_types=1);

namespace App\DataStructure;

class WorldBuilder
{
	private int $size;
	private array $coordinates = [];

	public function getSize(): int
	{
		return $this->size;
	}

	public function setSize(int $size): void
	{
		$this->size = $size;
	}

	public function getCoordinates(): array
	{
		return $this->coordinates;
	}

	public function addCoordinate(int $x, int $y): void
	{
		$this->coordinates[] = new Coordinate($x, $y);
	}
}