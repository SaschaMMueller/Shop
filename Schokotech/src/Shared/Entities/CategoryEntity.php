<?php

namespace src\Shared\Entities;

class CategoryEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_category';
	public const TABLE_NAME = 'category';

	private ?int $idCategory;
	private ?int $parent;
	private int $sortingOrder;
	private int $categoryKey;

	public function getCategoryKey(): int
	{
		return $this->categoryKey;
	}

	public function setCategoryKey(int $categoryKey): self
	{
		$this->categoryKey = $categoryKey;

		return $this;
	}
	private bool $isRoot;

	public function getIdCategory(): ?int
	{
		return $this->idCategory;
	}

	public function setIdCategory(?int $idCategory): self
	{
		$this->idCategory = $idCategory;

		return $this;
	}

	public function getParent()
	{
		return $this->parent;
	}

	public function setParent($parent): self
	{
		$this->parent = $parent;

		return $this;
	}

	public function getSortingOrder(): int
	{
		return $this->sortingOrder;
	}

	public function setSortingOrder(int $sortingOrder): self
	{
		$this->sortingOrder = $sortingOrder;

		return $this;
	}

	public function getIsRoot(): bool
	{
		return $this->isRoot;
	}

	public function setIsRoot(bool $isRoot): self
	{
		$this->isRoot = $isRoot;

		return $this;
	}
}