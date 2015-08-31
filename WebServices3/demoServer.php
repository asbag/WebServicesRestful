<?php
/**
 * @author David Mezquíriz
 * @copyright 2015
 */

function ItemQuery ($itemname) {
	srand(crc32($itemname));
	$result = array('count' => rand(1,550), 'size' => rand(50,200));
	return $result;
}

$opts = Array();
//Useful if you send large amount of information.
$opts['compression'] = SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP;
$wdsl = 'demo.wdsl';
$server = new SoapServer($wsdl, $opts);
$server->addFunction('ItemQuery');
$server->handle();