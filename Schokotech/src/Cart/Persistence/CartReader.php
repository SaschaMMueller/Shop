<?php

namespace src\Cart\Persistence;

use PDO;
use src\Cart\Business\Model\CartItemTransferBuilder;
use src\Shared\TransferObjects\CartItemTransfer;

class CartReader
{
	private CartQueryContainer $cartQueryContainer;
	private CartItemTransferBuilder $cartItemTransferBuilder;

	public function __construct(CartQueryContainer $cartQueryContainer, CartItemTransferBuilder $cartItemTransferBuilder)
	{
		$this->cartQueryContainer = $cartQueryContainer;
		$this->cartItemTransferBuilder = $cartItemTransferBuilder;
	}

	public function findCartItemDataBySku(string $sku, int $amount): CartItemTransfer
	{
		$query = $this->cartQueryContainer->findCartItemDataBySkuQuery($sku);
		$query->execute();
		$cartItemData = $query->fetch(PDO::FETCH_OBJ);

		return $this->cartItemTransferBuilder->buildCartItemTransferBySku($sku, $cartItemData, $amount);
	}
}