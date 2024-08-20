<?php
declare(strict_types=1);

namespace App\Game\Decision;

use App\DataStructure\Area;
use App\Game\Strategy\Strategy;

interface Handler
{
	public function setNext(Handler $handler): Handler;
	public function handle(Area $area): ?Strategy;
}