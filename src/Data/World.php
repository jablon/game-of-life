<?php
declare(strict_types=1);

namespace App\Data;

readonly class World
{
	public function __construct(
		private int $size,
		private int $iterations,
	)
	{
	}

	public function getSize(): int
	{
		return $this->size;
	}

	public function getIterations(): int
	{
		return $this->iterations;
	}
}