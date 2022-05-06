<?php

namespace src\Service\Session;

use src\Shared\TransferObjects\CartTransfer;
use src\Shared\TransferObjects\CustomerTransfer;
use src\Shared\TransferObjects\MessageTransfer;

class SessionService implements SessionServiceInterface
{
	public function findOrCreateCartTransferInSession(): CartTransfer
	{
		return $this->getFactory()->createSessionManager()->findOrCreateCartTransferInSession();
	}

	public function updateCartInSession(CartTransfer $cartTransfer): void
	{
		$this->getFactory()->createSessionManager()->updateCartInSession($cartTransfer);
	}

	public function findOrCreateMessageTransferInSession(): MessageTransfer
	{
		return $this->getFactory()->createSessionManager()->findOrCreateMessageTransferInSession();
	}

	public function updateMessageTransferInSession(MessageTransfer $messageTransfer): void
	{
		$this->getFactory()->createSessionManager()->updateMessageTransferInSession($messageTransfer);
	}

	public function deleteMessageTransferInSession(): void
	{
		$this->getFactory()->createSessionManager()->deleteMessageTransferInSession();
	}

	public function findOrCreateCustomerTransferInSession(): CustomerTransfer
	{
		return $this->getFactory()->createSessionManager()->findOrCreateCustomerTransferInSession();
	}

	public function setCustomerTransferInSession(CustomerTransfer $customerStepTransfer): void
	{
		$this->getFactory()->createSessionManager()->setCustomerTransferInSession($customerStepTransfer);
	}

	public function findOrCreateReachedCheckoutStepInSession(): int
	{
		return $this->getFactory()->createSessionManager()->findOrCreateReachedCheckoutStepInSession();
	}

	public function setReachedCheckoutStepInSession(int $reachedCheckoutStep): void
	{
		$this->getFactory()->createSessionManager()->setReachedCheckoutStepInSession($reachedCheckoutStep);
	}

	private function getFactory(): SessionFactory
	{
		return new SessionFactory();
	}
}