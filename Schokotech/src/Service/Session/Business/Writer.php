<?php

namespace src\Service\Session\Business;

use src\Service\Session\SessionServiceConstants;
use src\Shared\TransferObjects\CartTransfer;
use src\Shared\TransferObjects\CustomerTransfer;
use src\Shared\TransferObjects\MessageTransfer;

class Writer
{
	public function setCartTransferInSession(CartTransfer $cartTransfer): CartTransfer
	{
		$_SESSION[SessionServiceConstants::SESSION_KEY_CART] = $cartTransfer;

		return $_SESSION[SessionServiceConstants::SESSION_KEY_CART];
	}

	public function setMessageTransferInSession(MessageTransfer $messageTransfer): MessageTransfer
	{
		$_SESSION[SessionServiceConstants::SESSION_KEY_MESSAGES] = $messageTransfer;

		return $_SESSION[SessionServiceConstants::SESSION_KEY_MESSAGES];
	}

	public function deleteMessageTransferInSession(): void
	{
		$_SESSION[SessionServiceConstants::SESSION_KEY_MESSAGES] = null;
	}

	public function setCustomerTransferInSession(CustomerTransfer $customerTransfer): CustomerTransfer
	{
		$_SESSION[SessionServiceConstants::SESSION_KEY_CUSTOMER] = $customerTransfer;

		return $_SESSION[SessionServiceConstants::SESSION_KEY_CUSTOMER];
	}

	public function setReachedCheckoutStepInSession(int $reachedCheckoutStep): int
	{
		$_SESSION[SessionServiceConstants::SESSION_KEY_REACHED_CHECKOUT_STEP] = $reachedCheckoutStep;

		return $_SESSION[SessionServiceConstants::SESSION_KEY_REACHED_CHECKOUT_STEP];
	}
}