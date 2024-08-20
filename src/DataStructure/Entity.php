<?php
declare(strict_types=1);

namespace App\DataStructure;

class Entity
{

	public function __construct(
		private ?EntityState $state = null
	)
	{
		$this->state = $state === null ? EntityState::LIVE : $state;
	}

	public function isLive(): bool
	{
		return EntityState::LIVE === $this->state;
	}

	public function isDeath(): bool
	{
		return EntityState::DEATH === $this->state;
	}

	public function setState(EntityState $state): void
	{
		$this->state = $state;
	}
}