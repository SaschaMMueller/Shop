<?php

namespace src\Service\Session\Business;

use src\Service\Session\SessionServiceConstants;
use src\Shared\TransferObjects\CartTransfer;
use src\Shared\TransferObjects\CustomerTransfer;
use src\Shared\TransferObjects\MessageTransfer;

class Reader
{
	public function getCartTransferFromSession(): ?CartTransfer
	{
		if(!isset($_SESSION[SessionServiceConstants::SESSION_KEY_CART]))
		{
			return null;
		}

		return $_SESSION[SessionServiceConstants::SESSION_KEY_CART];
	}

	public function getMessageTransferFromSession(): ?MessageTransfer
	{
		if(!isset($_SESSION[SessionServiceConstants::SESSION_KEY_MESSAGES]))
		{
			return null;
		}

		return $_SESSION[SessionServiceConstants::SESSION_KEY_MESSAGES];
	}

	public function getCustomerTransferFromSession(): ?CustomerTransfer
	{
		if(!isset($_SESSION[SessionServiceConstants::SESSION_KEY_CUSTOMER]))
		{
			return null;
		}

		return $_SESSION[SessionServiceConstants::SESSION_KEY_CUSTOMER];
	}

	public function getReachedCheckoutStepFromSession(): ?int
	{
		if(!isset($_SESSION[SessionServiceConstants::SESSION_KEY_REACHED_CHECKOUT_STEP]))
		{
			return null;
		}

		return $_SESSION[SessionServiceConstants::SESSION_KEY_REACHED_CHECKOUT_STEP];
	}
}