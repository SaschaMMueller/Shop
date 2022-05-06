<?php

namespace src\Shared\TransferObjects;

use ArrayObject;

class CartTransfer
{
	private ArrayObject $cartItemTransfers;
	private int $totalItemCount;
	private float $totalPrice;

	public function getCartItemTransfers(): ArrayObject
	{
		return $this->cartItemTransfers;
	}

	public function setCartItemTransfers(ArrayObject $cartItemTransfers): self
	{
		$this->cartItemTransfers = $cartItemTransfers;

		return $this;
	}

	public function getTotalItemCount(): int
	{
		return $this->totalItemCount;
	}

	public function setTotalItemCount(int $totalItemCount): self
	{
		$this->totalItemCount = $totalItemCount;

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
}