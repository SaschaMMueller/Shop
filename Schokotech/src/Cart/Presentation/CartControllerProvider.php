<?php

namespace src\Cart\Presentation;

class CartControllerProvider
{
	public function getActionToSeoUrlMappings(): array
	{
		return [
			'add-to-cart' => 'Cart/addToCart/',
			'remove-item-from-cart' => 'Cart/removeItemFromCart/',
			'update-cart' => 'Cart/updateCart/'
		];
	}
}