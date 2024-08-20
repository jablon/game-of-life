<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use Exception;

class ContextFactory
{
	private static ?Context $instance = null;

	protected function __construct() { }

	protected function __clone() { }

	public function __wakeup()
	{
		throw new Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): Context
	{
		if (self::$instance === null) {
			self::$instance = new Context(LiveStrategyFactory::getInstance());
		}

		return self::$instance;
	}
}