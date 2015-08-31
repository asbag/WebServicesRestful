<?php
/**
 * Get all the wishes from database
 * @author David Mezquíriz Osés
 * @copyright 2015. David Mezquíriz Osés
 */

require_once('Meta.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	//Handle get request
	$metas = Meta::getAll();
	
	if ($metas) {
		$datos["estado"] = 1;
		$datos["metas"] = $metas;
		
		print(json_encode($datos));
	} else {
		print(json_enconde(array("estado"=>2, "metas"=>"An error came across")));
	}
}