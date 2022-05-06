<?php

namespace src\Cart\Business\Model;

use src\Shared\TransferObjects\CartItemTransfer;
use stdClass;

class CartItemTransferBuilder
{
	public function buildCartItemTransferBySku(string $sku, stdClass $cartItemData, int $amount): CartItemTransfer
	{
		return (new CartItemTransfer())
			->setSku($sku)
			->setName($cartItemData->name)
			->setImage($cartItemData->image_path)
			->setSizeName($cartItemData->size)
			->setPrice($cartItemData->price)
			->setTotalPrice($cartItemData->price)
			->setAmount($amount)
			->setSeoUrl($cartItemData->url_seo);
	}
}