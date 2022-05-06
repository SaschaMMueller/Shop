<?php

namespace src\Application;

class ApplicationFacade implements ApplicationFacadeInterface
{
	public function registerTwigWithExtensions(): void
	{
		$this->getFactory()->createTwigExtensionProvider()->registerTwigExtension();
	}

	private function getFactory(): ApplicationFactory
	{
		return new ApplicationFactory();
	}
}