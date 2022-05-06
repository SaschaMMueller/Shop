<?php

namespace src\Service\Session\Business;

use ArrayObject;
use src\Service\Session\SessionServiceConstants;
use src\Shared\TransferObjects\CartTransfer;
use src\Shared\TransferObjects\CustomerTransfer;
use src\Shared\TransferObjects\MessageTransfer;

class SessionManager
{
	private Reader $reader;
	private Writer $writer;

	public function __construct(Reader $reader, Writer $writer)
	{
		$this->reader = $reader;
		$this->writer = $writer;
	}

	public function findOrCreateCartTransferInSession(): CartTransfer
	{
		$cartTransfer = $this->reader->getCartTransferFromSession();

		if(empty($cartTransfer))
		{
			$cartTransfer = $this->buildInitialCartTransfer();
		}

		return $cartTransfer;
	}

	public function updateCartInSession(CartTransfer $cartTransfer): void
	{
		$this->writer->setCartTransferInSession($cartTransfer);
	}

	public function findOrCreateMessageTransferInSession(): MessageTransfer
	{
		$messageTransfer = $this->reader->getMessageTransferFromSession();

		if(empty($messageTransfer))
		{
			$messageTransfer = $this->writer->setMessageTransferInSession((new MessageTransfer())->setMessage(""));
		}

		return $messageTransfer;
	}

	public function updateMessageTransferInSession(MessageTransfer $messageTransfer): void
	{
		$this->writer->setMessageTransferInSession($messageTransfer);
	}

	public function deleteMessageTransferInSession(): void
	{
		$this->writer->deleteMessageTransferInSession();
	}

	public function findOrCreateCustomerTransferInSession(): CustomerTransfer
	{
		$customerTransfer = $this->reader->getCustomerTransferFromSession();

		if(empty($customerTransfer))
		{
			$customerTransfer = $this->writer->setCustomerTransferInSession(
				(new CustomerTransfer())
					->setCustomerName("")
					->setCustomerSurname("")
					->setEmail("")
					->setBillingName("")
					->setBillingSurname("")
					->setBillingSalutation("")
					->setBillingStreetAddress("")
					->setBillingStreetNumber("")
					->setBillingPostalCode("")
					->setBillingCompany("")
					->setShippingName("")
					->setShippingSurname("")
					->setShippingSalutation("")
					->setShippingStreetAddress("")
					->setShippingStreetNumber("")
					->setShippingPostalCode("")
					->setShippingCompany("")
					->setChkBox("")
			);
		}

		return $customerTransfer;
	}

	public function setCustomerTransferInSession(CustomerTransfer $customerTransfer): void
	{
		$this->writer->setCustomerTransferInSession($customerTransfer);
	}

	public function findOrCreateReachedCheckoutStepInSession(): int
	{
		$reachedCheckoutStep = $this->reader->getReachedCheckoutStepFromSession();

		if(empty($reachedCheckoutStep))
		{
			$reachedCheckoutStep = $this->writer->setReachedCheckoutStepInSession(SessionServiceConstants::SESSION_KEY_DEFAULT_REACHED_CHECKOUT_STEP);
		}

		return $reachedCheckoutStep;
	}

	public function setReachedCheckoutStepInSession(int $reachedCheckoutStep): void
	{
		$highestReachedStep = $this->reader->getReachedCheckoutStepFromSession();

		if($highestReachedStep < $reachedCheckoutStep)
		{
			$this->writer->setReachedCheckoutStepInSession($reachedCheckoutStep);
		}
	}

	private function buildInitialCartTransfer(): CartTransfer
	{
		$cartTransfer = new CartTransfer();
		$cartTransfer->setCartItemTransfers(new ArrayObject());
		$cartTransfer->setTotalItemCount(0);
		$cartTransfer->setTotalPrice(0.00);

		$cartTransfer = $this->writer->setCartTransferInSession($cartTransfer);

		return $cartTransfer;
	}
}