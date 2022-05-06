<?php

namespace src\CmsPage\Persistence;

use ArrayObject;
use PDO;
use src\CmsPage\Business\Model\ContactsTransferBuilder;

class CmsPageReader
{
	private CmsPageQueryContainer $cmsPageQueryContainer;
	private ContactsTransferBuilder $contactsTransferbuilder;

	public function __construct(CmsPageQueryContainer $cmsPageQueryContainer, ContactsTransferBuilder $contactsTransferBuilder)
	{
		$this->cmsPageQueryContainer = $cmsPageQueryContainer;
		$this->contactsTransferbuilder = $contactsTransferBuilder;
	}

	public function findContacts(): ArrayObject
	{
		$query = $this->cmsPageQueryContainer->findContactsQuery();
		$query->execute();
		$contacts = $query->fetchAll(PDO::FETCH_OBJ);

		return $this->contactsTransferbuilder->buildContactsTransfer($contacts);
	}
}