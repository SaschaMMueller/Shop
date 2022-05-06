<?php

namespace src\Application\Presentation;

use kernel\Presentation\BaseController;
use src\Application\ApplicationFactory;

class ApplicationController extends BaseController
{
	public function indexAction(): void
	{
		echo $this->getFactory()->getTwig()->render('Application/Presentation/tpl/index.twig');
	}

	private function getFactory(): ApplicationFactory
	{
		return new ApplicationFactory();
	}
}