<?php
/*
 * @author ilaya
 * file to set session of user
 */
session_start ();
if (isset ( $_SESSION ['uid'] )) {
	header ( 'Location: ../../web/home.php' );
	exit ( 0 );
}

include_once 'credentials.php';
$con = pg_connect ( "host=" . $dbHost . " port=" . $dbPort . " dbname=" . $dbName . " user=" . $dbUser . " password=" . $dbPass );
if (! $con) {
	echo "Error : Unable to open database\n";
}
$query = "select password,uid,uname from jaipal.users where emailid='" . $_POST ['Email'] . "';";
$ret = pg_query ( $con, $query );
pg_close ( $con );
if (! $ret) {
	echo pg_last_error ( $db );
	exit ();
}
if ($row = pg_fetch_row ( $ret )) {
	if ($row [0] == md5 ( $_POST ['Password'] . $salt )) {
		// IF LOGIN IS CORRECT THEN SESSION IS STARTED HERE
		$_SESSION ['uid'] = md5 ( $row ['uid'] );
		$_SESSION ['name'] = $row ['uname'];
		header ( 'Location: ../../web/home.php' );
		exit ( 0 );
	} else {
		echo "either username or password incorrect";
	}
} else {
	echo "either username or password incorrect";
}
?>