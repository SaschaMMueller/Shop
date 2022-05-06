<?php

namespace src\Application\Twig;

use Twig\Environment;

class TwigExtensionProvider
{
	private TwigExtension $twigExtension;
	private Environment $twig;

	public function __construct(TwigExtension $twigExtensions, Environment $twig)
	{
		$this->twigExtension = $twigExtensions;
		$this->twig = $twig;
	}

	public function registerTwigExtension(): void
	{
		$this->twig->addExtension($this->twigExtension);
	}
}