<?php

namespace src\Shared\TransferObjects;

class ProductVariantsTransfer
{
	private string $sku;
	private string $sizeName;
	private float $price;

	public function getSku(): string
	{
		return $this->sku;
	}

	public function setSku(string $sku): self
	{
		$this->sku = $sku;

		return $this;
	}

	public function getSizeName(): string
	{
		return $this->sizeName;
	}

	public function setSizeName(string $sizeName): self
	{
		$this->sizeName = $sizeName;

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