<?php
declare(strict_types=1);

namespace App\DataStructure;

class HashTable
{
	private array $table;

	public function __construct(
		private readonly int $size,
	)
	{
		$this->table = array_fill(0, $this->size, null);
	}

	private function hash(int $x, int $y): float
	{
		return ($x * 31 + $y) % $this->size;
	}

	public function insert(int $x, int $y, Area $area): void
	{
		$index = $this->hash($x, $y);

		$this->table[$index][] = [
			'x' => $x,
			'y' => $y,
			'value' => $area,
		];
	}

	public function search(int $x, int $y): ?Area
	{
		$index = $this->hash($x, $y);

		if (array_key_exists($index, $this->table) && $this->table[$index] !== null) {
			foreach ($this->table[$index] as $item) {
				if ($item['x'] === $x && $item['y'] === $y) {
					return $item['value'];
				}
			}
		}

		return null;
	}
}