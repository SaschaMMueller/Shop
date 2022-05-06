<?php

namespace src\Application\Twig;

use src\Application\Twig\Functions\CartItemTotalsFunction;
use src\Application\Twig\Functions\DisplayMessageFunction;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
	private CartItemTotalsFunction $cartItemTotalsFunction;
	private DisplayMessageFunction $displayMessageFunction;

	public function __construct(CartItemTotalsFunction $cartItemTotalsFunction,
								DisplayMessageFunction $displayMessageFunction)
	{
		$this->cartItemTotalsFunction = $cartItemTotalsFunction;
		$this->displayMessageFunction = $displayMessageFunction;
	}

	public function getFunctions(): array
	{
		return [
			new TwigFunction('cartItemTotalCount', [$this->cartItemTotalsFunction, 'getCartItemTotalCount']),
			new TwigFunction('displayMessage', [$this->displayMessageFunction, 'displayMessage'])
		];
	}
}