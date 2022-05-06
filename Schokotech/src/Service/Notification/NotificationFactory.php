<?php

namespace src\Service\Notification;

use src\Service\Notification\Business\NotificationHandler;
use src\Service\Session\SessionServiceInterface;

class NotificationFactory
{
	public function createNotificationHandler(): NotificationHandler
	{
		return new NotificationHandler($this->getSessionService());
	}

	private function getSessionService(): SessionServiceInterface
	{
		return $this->createNotificationDependencyProvider()->createSessionService();
	}

	private function createNotificationDependencyProvider(): NotificationDependencyProvider
	{
		return new NotificationDependencyProvider();
	}
}