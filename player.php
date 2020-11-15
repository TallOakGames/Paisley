<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function loopThroughDirectory($directory) {
	$fileList = glob($directory.'/*');
	return $fileList;
}
function addFileToDirectory($directory, $name) {
	$fp = $directory."/".$name;
	if (fopen($fp, "x+") == FALSE) {
		return false;
	} else {
		return true;
	}
}
function removeItemFromDirectory($directory, $name) {
	return unlink($directory."/".$name);
}
function getPlayerInventory($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/inv";
	return loopThroughDirectory($fp);
}
function addInventoryItem($id, $friend) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/inv";
	addFileToDirectory($fp, $friend);
}
function removeInventoryItem($id, $what) {
	$fp = getcwd()."/paisleycache/players/".$id."/inv";
	return removeItemFromDirectory($fp, $what);
}
function getPlayerFriends($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/fri";
	return loopThroughDirectory($fp);
}
function addFriend($id, $friend) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/fri";
	addFileToDirectory($fp, $friend);
	if (!file_exists("paisleycache/players/".$friend)) {
		mkdir("paisleycache/players/".$friend, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$friend."/fri";
	addFileToDirectory($fp, $id);
}
function removeFriend($id, $who) {
	$fp = getcwd()."/paisleycache/players/".$id."/fri";
	removeItemFromDirectory($fp, $who);
	$fp = getcwd()."/paisleycache/players/".$who."/fri";
	removeItemFromDirectory($fp, $id);
}
function getPlayerActiveRequests($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/activereq";
	return loopThroughDirectory($fp);
}
function removeActiveRequest($id, $from) {
	$fp = getcwd()."/paisleycache/players/".$id."/activereq";
	return removeItemFromDirectory($fp, $from);
}
function getPlayerSentFriendRequests($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/sentreq";
	return loopThroughDirectory($fp);
}
function addRequest($id, $from) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/activereq";
	addFileToDirectory($fp, $from);
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$from."/sentreq";
	addFileToDirectory($fp, $id);
}
function removeSentRequest($id, $from) {
	$fp = getcwd()."/paisleycache/players/".$id."/sentreq";
	return removeItemFromDirectory($fp, $from);
}
function getPlayerNotifications($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/notifications";
	return loopThroughDirectory($fp);
}
function sendNotification($id, $message, $rel) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/notifications";
	addFileToDirectory($fp, count(getPlayerNotifications($id)));
	$f = fopen($fp, "w+");
	fwrite($f, $message."\n".$rel);
	fclose($f);
}
function acceptFriendRequest($id, $from) {
	if (array_search($id, getPlayerFriends($id), FALSE) === false) {
		addFriend($id, $from);
		sendNotification($from, $id." accepted your friend request.");
	}
	removeActiveRequest($id, $from);
	removeSentRequest($from, $id);
}

function declineFriendRequest($id, $from) {
	removeActiveRequest($id, $from);
	removeSentRequest($from, $id);
}
?>