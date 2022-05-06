<?php

namespace src\Importer\Business\FileParsers;

interface ImportFileParserInterface
{
	public function parse($importFile): string;
}