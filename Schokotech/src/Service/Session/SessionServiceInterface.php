<?php

namespace src\Service\Session;

use src\Shared\TransferObjects\CartTransfer;
use src\Shared\TransferObjects\CustomerTransfer;
use src\Shared\TransferObjects\MessageTransfer;

interface SessionServiceInterface
{
	public function findOrCreateCartTransferInSession(): CartTransfer;
	public function updateCartInSession(CartTransfer $cartTransfer): void;
	public function findOrCreateMessageTransferInSession(): MessageTransfer;
	public function updateMessageTransferInSession(MessageTransfer $messageTransfer): void;
	public function deleteMessageTransferInSession(): void;
	public function findOrCreateCustomerTransferInSession(): CustomerTransfer;
	public function setCustomerTransferInSession(CustomerTransfer $customerStepTransfer): void;
	public function findOrCreateReachedCheckoutStepInSession(): int;
	public function setReachedCheckoutStepInSession(int $reachedCheckoutStep): void;
}