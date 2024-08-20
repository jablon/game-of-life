<?php
declare(strict_types=1);

namespace App\Reader;

use App\Data\Life;
use App\Data\Organism;
use App\Data\World;
use Exception;
use InvalidArgumentException;
use SimpleXMLElement;

readonly class XmlFileReader implements Reader
{
	public function __construct(
		private string $path,
	)
	{
	}

	public function read(): Life
	{
		if (!file_exists($this->path)) {
			throw new InvalidArgumentException("Unable to read nonexistent file");
		}

		try {
			libxml_use_internal_errors(true);
			$file = simplexml_load_string(file_get_contents($this->path));
			$errors = libxml_get_errors();
			libxml_clear_errors();
			if (count($errors) > 0) {
				throw new InvalidArgumentException("Cannot read XML file");
			}
		} catch (Exception) {
			throw new InvalidArgumentException("Cannot read XML file");
		}

		$world = new World((int) $file->world->size, (int) $file->world->iterations);

		$life = new Life($world);

		/** @var SimpleXMLElement $organism */
		foreach ($file->organisms->organism as $organism) {
			$life->addOrganism(new Organism(
				(int) $organism->x_pos,
				(int) $organism->y_pos,
			));
		}

		return $life;
	}
}