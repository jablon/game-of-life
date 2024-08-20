<?php
declare(strict_types=1);

namespace App\DataStructure;

class Area
{
	private Coordinate $coordinate;
	private ?Area $up = null;
	private ?Area $down = null;
	private ?Area $left = null;
	private ?Area $right = null;
	private ?Entity $entity = null;

	public function __construct(
		int $x,
		int $y,
	)
	{
		$this->coordinate = new Coordinate($x, $y);
	}

	public function getCoordinate(): Coordinate
	{
		return $this->coordinate;
	}

	public function getUp(): ?Area
	{
		return $this->up;
	}

	public function setUp(Area $up): void
	{
		$this->up = $up;
	}

	public function getDown(): ?Area
	{
		return $this->down;
	}

	public function setDown(Area $down): void
	{
		$this->down = $down;
	}

	public function getLeft(): ?Area
	{
		return $this->left;
	}

	public function setLeft(Area $left): void
	{
		$this->left = $left;
	}

	public function getRight(): ?Area
	{
		return $this->right;
	}

	public function setRight(Area $right): void
	{
		$this->right = $right;
	}

	public function isEmpty(): bool
	{
		return $this->entity === null;
	}

	public function getEntity(): ?Entity
	{
		return $this->entity;
	}

	public function setEntity(?Entity $entity): void
	{
		$this->entity = $entity;
	}
}