<?php
session_start ();
if (! isset ( $_SESSION ['user'] )) {
	header ( 'Location: login.php' );
	exit ( 0 );
}
$root = "../";

$uri = ($_SERVER ['REQUEST_URI']);
$exploaded = explode ( "/", $uri );
$lastParamLoc = sizeof ( $exploaded );
$id = $exploaded [$lastParamLoc - 1];

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>SocialEyes</title>
<link rel="stylesheet" href="../css/normalize.css" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/profile.css" />

</head>
<body>
		 <?php include "../php/topNavBar.php";?>
		 <div
		class="col-xs-8 col-xs-offset-1 col-sm-8  col-sm-offset-1 col-md-8  col-md-offset-1 col-lg-8 col-lg-offset-1"
		style="margin-top: 3.5em;">
		<div class="main-content">
		 		<?php
					include '../../src/postgres/query.php';
					$o = new query ();
					?>
		 		<div class="coverpic">
				<img alt="cover"
					src="../../src/postgres/<?php echo $o->getCoverpicForUid($id);?>" />
			</div>

		</div>

	</div>

	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
		<div class="sidebar-nav-fixed pull-right affix">
				<?php include "../php/chat.php"; ?>
			</div>
	</div>

</body>
</html>