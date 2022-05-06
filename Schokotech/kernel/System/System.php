<?php

namespace kernel\System;

use kernel\SystemFactory;
use src\Importer\ImporterFactory;
use src\Shared\TransferObjects\RequestTransfer;

class System
{
	public function start(): void
	{
		session_start();
		$systemFactory = new SystemFactory();
		$request = (new RequestTransfer())->init();
		$systemFactory->getApplicationFacade()->registerTwigWithExtensions();
		$systemFactory->getUrlFacade()->resolveUrlForApplicationStart($request);
	}
}