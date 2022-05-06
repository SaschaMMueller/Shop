<?php

namespace src\Shared\TransferObjects;

class CartItemTransfer
{
	private string $sku;
	private string $name;
	private string $sizeName;
	private string $image;
	private float $price;
	private float $totalPrice;
	private int $amount;
	private string $seoUrl;

	public function getSku(): string
	{
		return $this->sku;
	}

	public function setSku(string $sku): self
	{
		$this->sku = $sku;

		return $this;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

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

	public function getImage(): string
	{
		return $this->image;
	}

	public function setImage(string $image): self
	{
		$this->image = $image;

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

	public function getTotalPrice(): float
	{
		return $this->totalPrice;
	}

	public function setTotalPrice(float $totalPrice): self
	{
		$this->totalPrice = $totalPrice;

		return $this;
	}

	public function getAmount(): int
	{
		return $this->amount;
	}

	public function setAmount(int $amount): self
	{
		$this->amount = $amount;

		return $this;
	}

	public function getSeoUrl(): string
	{
		return $this->seoUrl;
	}

	public function setSeoUrl(string $seoUrl): self
	{
		$this->seoUrl = $seoUrl;

		return $this;
	}
}