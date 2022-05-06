<?php

namespace src\Category;

use src\Product\ProductFacade;
use src\Product\ProductFacadeInterface;
use src\Url\UrlFacade;
use src\Url\UrlFacadeInterface;

class CategoryDependencyProvider
{
	public function createUrlFacade(): UrlFacadeInterface
	{
		return new UrlFacade();
	}

	public function createProductFacade(): ProductFacadeInterface
	{
		return new ProductFacade();
	}
}