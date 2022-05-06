<?php

namespace src\Service\Notification;

use src\Service\Session\SessionService;
use src\Service\Session\SessionServiceInterface;

class NotificationDependencyProvider
{
	public function createSessionService(): SessionServiceInterface
	{
		return new SessionService();
	}
}