<?php

namespace src\Service\Notification;

use src\Shared\TransferObjects\MessageTransfer;

class NotificationService implements NotificationServiceInterface
{
	public function saveMessage(string $message): void
	{
		$this->getFactory()->createNotificationHandler()->saveMessage($message);
	}

	public function getMessage(): MessageTransfer
	{
		return $this->getFactory()->createNotificationHandler()->getMessage();
	}

	public function deleteMessages(): void
	{
		$this->getFactory()->createNotificationHandler()->deleteMessages();
	}

	private function getFactory(): NotificationFactory
	{
		return new NotificationFactory();
	}
}