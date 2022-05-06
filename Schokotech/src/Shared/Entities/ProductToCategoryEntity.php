<?php

namespace src\Shared\Entities;

class ProductToCategoryEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_product_to_category';
	public const TABLE_NAME = 'product_to_category';

	private ?int $idProductToCategory;
	private int $sortingOrder;
	private int $fkCategory;
	private int $fkProductAbstract;


	public function getIdProductToCategory(): ?int
	{
		return $this->idProductToCategory;
	}

	public function setIdProductToCategory(?int $idProductToCategory): self
	{
		$this->idProductToCategory = $idProductToCategory;

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

	public function getFkCategory(): int
	{
		return $this->fkCategory;
	}

	public function setFkCategory(int $fkCategory): self
	{
		$this->fkCategory = $fkCategory;

		return $this;
	}


	public function getFkProductAbstract(): int
	{
		return $this->fkProductAbstract;
	}


	public function setFkProductAbstract(int $fkProductAbstract): self
	{
		$this->fkProductAbstract = $fkProductAbstract;

		return $this;
	}
}