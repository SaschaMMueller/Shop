<?php

namespace src\Cart;

use src\Product\ProductFacade;
use src\Product\ProductFacadeInterface;
use src\Service\Notification\NotificationService;
use src\Service\Notification\NotificationServiceInterface;
use src\Service\Session\SessionService;
use src\Service\Session\SessionServiceInterface;

class CartDependencyProvider
{
	public function createSessionService(): SessionServiceInterface
	{
		return new SessionService();
	}

	public function createNotificationService(): NotificationServiceInterface
	{
		return new NotificationService();
	}
}