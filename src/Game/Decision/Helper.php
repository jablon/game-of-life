<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;

class Helper
{
	public static function liveCounter(Area $area): int
	{
		$counter = 0;

		foreach ([
			$area->getUp(),
			$area->getDown(),
        ] as $value) {
			if (self::neighborControl($value)) {
				++$counter;
			}

			if (self::neighborControl($value?->getRight())) {
				++$counter;
			}

			if (self::neighborControl($value?->getLeft())) {
				++$counter;
			}
		}

		foreach ([
			$area->getRight(),
			$area->getLeft(),
        ] as $value) {
			if (self::neighborControl($value)) {
				++$counter;
			}
		}

		return $counter;
	}

	private static function neighborControl(?Area $area): bool
	{
		return !$area?->isEmpty() && $area?->getEntity()->isLive();
	}
}