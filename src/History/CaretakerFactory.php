<?php
declare(strict_types=1);

namespace App\History;

use Exception;

class CaretakerFactory
{
	private static ?Caretaker $instance = null;

	protected function __construct() { }

	protected function __clone() { }

	public function __wakeup()
	{
		throw new Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): Caretaker
	{
		if (self::$instance === null) {
			self::$instance = new Caretaker;
		}

		return self::$instance;
	}
}