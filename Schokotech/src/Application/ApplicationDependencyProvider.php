<?php

namespace src\Application;

use src\Service\Notification\NotificationService;
use src\Service\Notification\NotificationServiceInterface;
use src\Service\Session\SessionService;
use src\Service\Session\SessionServiceInterface;

class ApplicationDependencyProvider
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