<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getPlayerInventory($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0777, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/inv.csv";
	if(!file_exists($fp)) {
		$f = fopen($fp, "x+");
		fclose($f);
		return [];
	};
	if (filesize($fp) == 0) {
		return [];
	}
	$f = fopen($fp, "r");
	$string = fread($f, filesize($fp));
	fclose($f);
	return explode(",\n", $string);
}
function getPlayerFriends($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0777, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/fri.csv";
	if(!file_exists($fp)) {
		$f = fopen($fp, "x+");
		fclose($f);
		return [];
	};
	if (filesize($fp) == 0) {
		return [];
	}
	$f = fopen($fp, "r");
	$string = fread($f, filesize($fp));
	fclose($f);
	return explode(",\n", $string);
}

echo implode(", ", getPlayerFriends(2));
?>