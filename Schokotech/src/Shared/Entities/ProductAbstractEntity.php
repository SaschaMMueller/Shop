<?php

namespace src\Shared\Entities;

class ProductAbstractEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_product_abstract';
	public const TABLE_NAME = 'product_abstract';

	private ?int $idProductAbstract;
	private string $sku;

	public function getIdProductAbstract(): ?int
	{
		return $this->idProductAbstract;
	}

	public function setIdProductAbstract(?int $idProductAbstract): self
	{
		$this->idProductAbstract = $idProductAbstract;

		return $this;
	}

	public function getSku(): string
	{
		return $this->sku;
	}

	public function setSku(string $sku): self
	{
		$this->sku = $sku;

		return $this;
	}
}