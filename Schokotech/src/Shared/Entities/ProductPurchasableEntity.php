<?php

namespace src\Shared\Entities;

class ProductPurchasableEntity extends BaseEntity
{
	public const COLUMN_ID_NAME = 'id_product_purchasable';
	public const TABLE_NAME = 'product_purchasable';

	private ?int $id_product_purchasable;
	private string $sku;
	private int $size;
	private int $stock;
	private int $fkProductAbstract;
	private float $price;

	public function getIdProductPurchasable(): ?int
	{
		return $this->id_product_purchasable;
	}

	public function setIdProductPurchasable(?int $id_product_purchasable): self
	{
		$this->id_product_purchasable = $id_product_purchasable;

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

	public function getSize(): int
	{
		return $this->size;
	}

	public function setSize(int $size): self
	{
		$this->size = $size;

		return $this;
	}

	public function getStock(): int
	{
		return $this->stock;
	}

	public function setStock(int $stock): self
	{
		$this->stock = $stock;

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

	public function getPrice(): float
	{
		return $this->price;
	}

	public function setPrice(float $price): self
	{
		$this->price = $price;

		return $this;
	}
}