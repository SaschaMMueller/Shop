<?php

namespace src\Service\Notification;

use src\Shared\TransferObjects\MessageTransfer;

interface NotificationServiceInterface
{
	public function saveMessage(string $message): void;
	public function getMessage(): MessageTransfer;
	public function deleteMessages(): void;
}