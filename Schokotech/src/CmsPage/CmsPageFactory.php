<?php

namespace src\CmsPage;

use src\CmsPage\Business\Model\ContactsTransferBuilder;
use src\CmsPage\Persistence\CmsPageQueryContainer;
use src\CmsPage\Persistence\CmsPageReader;
use src\DatabaseConnector;
use src\Product\ProductFacadeInterface;
use src\Shared\System\Application;
use Twig\Environment;

class CmsPageFactory
{
	public function getTwig(): Environment
	{
		return Application::getInstance()->getTwig();
	}

	public function createCmsPageReader(): CmsPageReader
	{
		return new CmsPageReader($this->createCmsPageQueryContainer(), $this->createContactsTransferbuilder());
	}

	private function createCmsPageQueryContainer(): CmsPageQueryContainer
	{
		return new CmsPageQueryContainer($this->createDatabaseConnector());
	}

	private function createDatabaseConnector(): DatabaseConnector
	{
		return new DatabaseConnector();
	}

	private function createContactsTransferbuilder(): ContactsTransferBuilder
	{
		return new ContactsTransferBuilder();
	}
}