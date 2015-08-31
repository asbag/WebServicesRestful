<?php
$wsdl = 'http://localhost/WebServices/WebServices3/demo.wsdl';
$client = new SoapClient($wsdl);
$res = $client->ItemQuery('screwdriver');
$count = $res->count;
$size = $res->size;

print("Result of Soap Web Services --> Count = $count --- Size = $size");

