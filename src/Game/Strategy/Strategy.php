<?php
declare(strict_types=1);

namespace App\Game\Strategy;

use App\DataStructure\Entity;

interface Strategy
{
	public function doAction(?Entity $entity): ?Entity;
}