<?php

namespace src\Service\Session;

use src\Service\Session\Business\Reader;
use src\Service\Session\Business\SessionManager;
use src\Service\Session\Business\Writer;

class SessionFactory
{
	public function createSessionManager(): SessionManager
	{
		return new SessionManager($this->createReader(), $this->createWriter());
	}

	private function createWriter(): Writer
	{
		return new Writer;
	}

	private function createReader(): Reader
	{
		return new Reader;
	}
}