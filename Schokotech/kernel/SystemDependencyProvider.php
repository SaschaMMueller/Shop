<?php

namespace kernel;

use src\Application\ApplicationFacade;
use src\Application\ApplicationFacadeInterface;
use src\Url\UrlFacade;
use src\Url\UrlFacadeInterface;

class SystemDependencyProvider
{
	public function createApplicationFacade(): ApplicationFacadeInterface
	{
		return new ApplicationFacade();
	}

	public function createUrlFacade(): UrlFacadeInterface
	{
		return new UrlFacade();
	}
}