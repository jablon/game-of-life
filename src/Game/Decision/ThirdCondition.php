<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;
use App\Game\Strategy\DeathStrategyFactory;
use App\Game\Strategy\Strategy;

/**
 * Any live cell with more than three live neighbours dies, as if by overpopulation.
 */
class ThirdCondition extends AbstractHandler
{
	public function handle(Area $area): ?Strategy
	{
		return $area->getEntity()?->isLive() && Helper::liveCounter($area) > 3 ?
			DeathStrategyFactory::getInstance() :
			parent::handle($area);
	}
}