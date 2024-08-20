<?php
declare(strict_types=1);

namespace App\Game\Decision;

use Exception;

class ConditionFactory
{
	private static ?Handler $instance = null;

	protected function __construct() { }

	protected function __clone() { }

	public function __wakeup()
	{
		throw new Exception("Cannot unserialize a singleton.");
	}

	public static function getInstance(): Handler
	{
		if (self::$instance === null) {
			$firCondition = new FirstCondition;
			$secondCondition = new SecondCondition;
			$thirdCondition = new ThirdCondition;
			$fourCondition = new FourthCondition;

			$firCondition->setNext($secondCondition)
				->setNext($thirdCondition)
				->setNext($fourCondition);

			self::$instance = $firCondition;
		}

		return self::$instance;
	}
}