<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;
use App\Game\Strategy\DeathStrategyFactory;
use App\Game\Strategy\Strategy;

/**
 * Any live cell with fewer than two live neighbours dies, as if by underpopulation.
 */
class FirstCondition extends AbstractHandler
{
	public function handle(Area $area): ?Strategy
	{
		return !$area->isEmpty() && $area->getEntity()?->isLive() && Helper::liveCounter($area) < 2 ?
			DeathStrategyFactory::getInstance() :
			parent::handle($area);
	}
}