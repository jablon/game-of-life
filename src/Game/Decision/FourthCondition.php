<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;
use App\Game\Strategy\LiveStrategyFactory;
use App\Game\Strategy\Strategy;

/**
 * Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction.
 */
class FourthCondition extends AbstractHandler
{
	public function handle(Area $area): ?Strategy
	{
		return $area->getEntity()?->isDeath() && Helper::liveCounter($area) === 3 ?
			LiveStrategyFactory::getInstance() :
			parent::handle($area);
	}
}