<?php

namespace src\Product;

use src\Url\UrlFacade;
use src\Url\UrlFacadeInterface;

class ProductDependencyProvider
{
	public function createUrlFacade(): UrlFacadeInterface
	{
		return new UrlFacade();
	}
}