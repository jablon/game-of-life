<?php
declare(strict_types=1);

namespace App\Reader;

use App\Data\Life;

interface Reader
{
	public function read(): Life;
}