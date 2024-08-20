<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;
use App\Game\Strategy\LiveStrategyFactory;
use App\Game\Strategy\Strategy;

/**
 * Any live cell with two or three live neighbours lives on to the next generation.
 */
class SecondCondition extends AbstractHandler
{
	public function handle(Area $area): ?Strategy
	{
		$counter = Helper::liveCounter($area);
		return $counter === 2 || $counter === 3 ?
			LiveStrategyFactory::getInstance() :
			parent::handle($area);
	}
}