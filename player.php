<?php
function getPlayerInventory($id) {
	$fp = getcwd()."/paisleycache/players/".$id."/inv.csv"
	if(!file_exists($fp)) {
		$f = fopen($fp, "x+");
		fclose($f);
	}
}