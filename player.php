<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
function getPlayerInventory($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
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
function removeInventoryItem($id, $what) {
	$original = getPlayerSentFriendRequests($id);
	$fp = getcwd()."/paisleycache/players/".$id."/sentreq.csv";
	fopen($fp, "w+");
	$removed = false;
	foreach ($original as $key => $value) {
		if (("".$value != "".$what) or ($removed)) {
			fwrite($fp, $value."\n");
		} else {
			$removed = true;
		}
	}
	fclose($fp);
}
function getPlayerFriends($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
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
function addFriend($id, $friend) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/fri.csv";
	$f = fopen($fp, "a");
	fwrite($f, "".$friend."\n");
	fclose($f);
	if (!file_exists("paisleycache/players/".$friend)) {
		mkdir("paisleycache/players/".$friend, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$friend."/fri.csv";
	$f = fopen($fp, "a");
	fwrite($f, "".$id."\n");
	fclose($f);
}
function removeFriend($id, $who) {
	$original = getPlayerSentFriendRequests($id);
	$fp = getcwd()."/paisleycache/players/".$id."/fri.csv";
	fopen($fp, "w+");
	foreach ($original as $key => $value) {
		if ("".$value != "".$who) {
			fwrite($fp, $value."\n");
		}
	}
	fclose($fp);
}
function getPlayerActiveFriendRequests($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/activereq.csv";
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
function removeActiveRequest($id, $from) {
	$original = getPlayerSentFriendRequests($id);
	$fp = getcwd()."/paisleycache/players/".$id."/activereq.csv";
	fopen($fp, "w+");
	foreach ($original as $key => $value) {
		if ("".$value != "".$from) {
			fwrite($fp, $value."\n");
		}
	}
	fclose($fp);
}
function getPlayerSentFriendRequests($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/sentreq.csv";
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
function addRequest($id, $from) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/activereq.csv";
	$f = fopen($fp, "a");
	fwrite($f, "".$from."\n");
	fclose($f);
	if (!file_exists("paisleycache/players/".$from)) {
		mkdir("paisleycache/players/".$from, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$from."/sentreq.csv";
	$f = fopen($fp, "a");
	fwrite($f, "".$id."\n");
	fclose($f);

}
function removeSentRequest($id, $from) {
	$original = getPlayerSentFriendRequests($id);
	$fp = getcwd()."/paisleycache/players/".$id."/sentreq.csv";
	fopen($fp, "w+");
	foreach ($original as $key => $value) {
		if ("".$value != "".$from) {
			fwrite($fp, $value."\n");
		}
	}
	fclose($fp);
}
function getPlayerNotifications($id) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/notifications.csv";
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
function sendNotification($id, $notification) {
	if (!file_exists("paisleycache/players/".$id)) {
		mkdir("paisleycache/players/".$id, 0770, true);
	}
	$fp = getcwd()."/paisleycache/players/".$id."/notifications.csv";
	$f = fopen($fp, "a");
	fwrite($f, htmlspecialchars($notification)."\n");
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