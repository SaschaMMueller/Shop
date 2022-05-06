<?php

namespace src\CmsPage\Presentation;

use kernel\Presentation\BaseController;
use src\CmsPage\CmsPageFactory;
use src\Shared\TransferObjects\RequestTransfer;

class CmsPageController extends BaseController
{
	public function aboutUsAction(): void
	{
		echo $this->getFactory()->getTwig()->render('CmsPage/Presentation/tpl/about-us.twig');
	}

	public function contactAction(): void
	{
		$contacts = $this->getFactory()->createCmsPageReader()->findContacts();
		echo $this->getFactory()->getTwig()->render('CmsPage/Presentation/tpl/contact.twig',  array('contacts' => $contacts));
	}

	private function getFactory(): CmsPageFactory
	{
		return new CmsPageFactory();
	}
}
