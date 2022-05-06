<?php

namespace src\Checkout;

use src\Service\Session\SessionService;
use src\Service\Session\SessionServiceInterface;

class CheckoutDependencyProvider
{
	public function createSessionService(): SessionServiceInterface
	{
		return new SessionService();
	}
}