<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use Exception;

class DeathStrategyFactory
{
	private static ?DeathStrategy $strategy = null;

	protected function __construct() { }

	protected function __clone() { }

	public function __wakeup()
	{
		throw new Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): DeathStrategy
	{
		if (self::$strategy === null) {
			self::$strategy = new DeathStrategy;
		}

		return self::$strategy;
	}
}