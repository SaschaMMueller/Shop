<?php

namespace src\Application\Twig\Functions;

use src\Service\Notification\NotificationServiceInterface;

class DisplayMessageFunction
{
	private NotificationServiceInterface $notificationService;

	public function __construct(NotificationServiceInterface $notificationService)
	{
		$this->notificationService = $notificationService;
	}

	public function displayMessage(): string
	{
		$message = $this->notificationService->getMessage()->getMessage();

		$this->notificationService->deleteMessages();

		return $message;
	}
}