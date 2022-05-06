<?php

use src\Importer\ImporterFactory;

require_once '../../Config.php';
require_once '../../vendor/autoload.php';

$importers = (new ImporterFactory())->createImporterProvider()->getImporters();

foreach($importers as $importer)
{
	if($importer->shouldImport() == false)
	{
		continue;
	}

	$importer->import();
}
