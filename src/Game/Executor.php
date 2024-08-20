<?php
declare(strict_types=1);

namespace App\Game;

use App\DataStructure\Area;
use App\DataStructure\World;
use App\Game\Decision\Handler;
use App\Game\Strategy\Context;

readonly class Executor
{
	public function __construct(
		private Handler $handler,
		private Context $context,
	)
	{
	}

	public function execute(World $world): World
	{
		$newWorld = new World($world->getSize());

		/** @var Area $area */
		foreach ($world as $area) {
			$strategy = $this->handler->handle($area);
			$coordinate = $area->getCoordinate();

			$this->context->setStrategy($strategy);
			$newEntity = $this->context->doAction($area);

			$newWorld->findByCoordinate($coordinate)->setEntity($newEntity);
		}

		return $newWorld;
	}
}