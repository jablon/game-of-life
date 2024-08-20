<?php
declare(strict_types=1);

namespace App\DataStructure;

use Iterator;

class World implements Iterator
{
	private Area $area;
	private ?Area $pointer;
	private Area $row;
	private HashTable $hashTable;

	public function __construct(
		private readonly int $size,
	)
	{
		$this->hashTable = new HashTable($this->size * $this->size);

		$this->pointer = $this->row = $this->area = new Area(0, 0);
		$this->hashTable->insert(0, 0, $this->area);

		for ($y=0; $y<$this->size; ++$y) {
			for ($x=0; $x<$this->size; ++$x) {
				if ($x === 0 && $y === 0) {
					continue;
				}

				if ($x === 0) { //new row -> set it
					$newRow = new Area($x, $y);
					$newRow->setUp($this->row);
					$this->row->setDown($newRow);

					$this->pointer = $this->row = $newRow;
					$this->hashTable->insert($x, $y, $newRow);
				} else {
					$area = new Area($x, $y);

					$area->setLeft($this->pointer);
					$this->pointer->setRight($area);

					if ($this->pointer->getUp()?->getRight() !== null) {
						$area->setUp($this->pointer->getUp()->getRight());
						$this->pointer->getUp()->getRight()->setDown($area);
					}
					$this->pointer = $area;
					$this->hashTable->insert($x, $y, $area);
				}
			}
		}

		//reset after inicialized grid
		$this->pointer = $this->row = $this->area;
	}

	public function getSize(): int
	{
		return $this->size;
	}

	public function current(): Area
	{
		return $this->pointer;
	}

	public function next(): void
	{
		if ($this->pointer->getRight() !== null) {
			$this->pointer = $this->pointer->getRight();
		} else if ($this->row->getDown() !== null) {
			$this->pointer = $this->row = $this->row->getDown();
		} else {
			$this->pointer = null;
		}
	}

	public function key(): Coordinate
	{
		return $this->pointer->getCoordinate();
	}

	public function valid(): bool
	{
		return $this->pointer !== null;
	}

	public function rewind(): void
	{
		$this->pointer = $this->area;
		$this->row = $this->area;
	}

	public function find(int $x, int $y): ?Area
	{
		return $this->hashTable->search($x, $y);
	}

	public function findByCoordinate(Coordinate $coordinate): ?Area
	{
		return $this->hashTable->search($coordinate->getX(), $coordinate->getY());
	}
}