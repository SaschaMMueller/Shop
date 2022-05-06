<?php

namespace src\CmsPage\Business\Model;

use ArrayObject;
use src\Shared\TransferObjects\CmsPageTransfer;
use stdClass;

class ContactsTransferBuilder
{
	public function buildContactsTransfer(array $contacts): ArrayObject
	{
		$cmsPageTransferCollection = new ArrayObject();

		foreach($contacts as $contact)
		{
			$cmsPageTransferCollection->append($this->buildContactTransfer($contact));
		}

		return $cmsPageTransferCollection;
	}

	private function buildContactTransfer(stdClass $contact): CmsPageTransfer
	{
		return (new CmsPageTransfer())
			->setName($contact->name)
			->setStreet($contact->street)
			->setHouseNumber($contact->house_number)
			->setPostalCode($contact->postal_code)
			->setCity($contact->city)
			->setTelephoneNumber($contact->telephone_number)
			->setEmail($contact->email);
	}
}
