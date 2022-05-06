<?php

namespace src\Service\Notification\Business;

use src\Service\Session\SessionServiceInterface;
use src\Shared\TransferObjects\MessageTransfer;

class NotificationHandler
{
	private SessionServiceInterface $sessionService;

	public function __construct(SessionServiceInterface $sessionService)
	{
		$this->sessionService = $sessionService;
	}

	public function saveMessage(string $message): void
	{
		$messageTransfer = $this->sessionService->findOrCreateMessageTransferInSession();
		$messageTransfer->setMessage($message);
		$this->sessionService->updateMessageTransferInSession($messageTransfer);
	}

	public function getMessage(): MessageTransfer
	{
		return $this->sessionService->findOrCreateMessageTransferInSession();
	}

	public function deleteMessages(): void
	{
		$this->sessionService->deleteMessageTransferInSession();
	}
}