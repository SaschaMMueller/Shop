<?php

namespace src\Url;

use src\Cart\Presentation\CartControllerProvider;
use src\Checkout\Presentation\CheckoutControllerProvider;

class UrlDependencyProvider
{
	public function getControllerProviders(): array
	{
		return [
			new CartControllerProvider(),
			new CheckoutControllerProvider()
		];
	}
}