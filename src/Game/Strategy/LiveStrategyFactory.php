<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use Exception;

class LiveStrategyFactory
{
	private static ?LiveStrategy $strategy = null;

	protected function __construct() { }

	protected function __clone() { }

	public function __wakeup()
	{
		throw new Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): LiveStrategy
	{
		if (self::$strategy === null) {
			self::$strategy = new LiveStrategy;
		}

		return self::$strategy;
	}
}