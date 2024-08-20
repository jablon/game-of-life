<?php
declare(strict_types=1);

namespace App\Render;

use App\DataStructure\Area;
use App\DataStructure\Coordinate;
use App\DataStructure\World;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Output\OutputInterface;

class Grid
{
	private World $world;

	public function __construct(
		private readonly OutputInterface $output,
	)
	{
	}

	public function setWorld(World $world): void
	{
		$this->world = $world;
	}

	public function render(): void
	{
		$table = new Table($this->output);

		$rows = [];

		/**
		 * @var Coordinate $coordinate
		 * @var Area $area
		 */
		foreach ($this->world as $coordinate => $area) {
			$row = ' ';
			if ($area->getEntity()?->isLive()) {
				$row = "\u{1f600}";
			} else if ($area->getEntity()?->isDeath()) {
				$row = "\u{2620}";
			}

			$rows[$coordinate->getX()][$coordinate->getY()] = $row;
		}

		foreach ($rows as $key => $row) {
			$table->addRow($row);
			if ($key < $this->world->getSize() - 1) {
				$table->addRow(new TableSeparator);
			}
		}

		$table->render();
	}
}