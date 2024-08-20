<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;
use App\Game\Strategy\Strategy;

abstract class AbstractHandler implements Handler
{

	private ?Handler $nextHandler = null;

	public function setNext(Handler $handler): Handler
	{
		return $this->nextHandler = $handler;
	}

	public function handle(Area $area): ?Strategy
	{
		return $this->nextHandler?->handle($area);
	}
}