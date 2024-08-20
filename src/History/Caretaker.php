<?php
declare(strict_types=1);

namespace App\History;

use App\DataStructure\World;

class Caretaker
{
	private array $mementos = [];

	public function backup(int $iteration, World $world): void
	{
		$this->mementos[$iteration] = new Memento($iteration, $world);
	}

	public function getHistory(int $iteration): ?Memento
	{
		return array_key_exists($iteration, $this->mementos) ? $this->mementos[$iteration] : null;
	}
}