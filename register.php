<?php
include "func.php";
database_open();
if(isset($_GET['reg']))
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php getSystemText("registrace", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.php">
			  		<?php getSystemText("umsebanka", $_SESSION['message_set']); ?>
			  	</a>
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" action="?reg" method="POST">
						<div class="module-head">
							<h3><?php getSystemText("vytvoritucet", $_SESSION['message_set']); ?></h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
                	
<?php
$pin = htmlspecialchars($_POST['pin'], ENT_QUOTES);
$zem = htmlspecialchars($_POST['zem'], ENT_QUOTES);
$inc = strtoupper(htmlspecialchars($_POST['inicialy'], ENT_QUOTES));
$firem = $_POST['firem'];
if(mb_strlen($inc,'UTF-8') == 2 && is_numeric($pin) && mb_strlen($pin,'UTF-8') == 4 && !is_numeric($inc))
{
	$porad = getZemProperty($zem, "porad") + 1;
		if($firem != 0)
		{
			$typ = 1;
		}else
		{
			$typ = 0;
		}
		 if(createUser($pin, $porad, $zem, $typ, $inc, 1) == true)
		 {
		  getSystemText("ucet", $_SESSION['message_set']);
		  echo "" . $zem . "" . leadingZeros($porad, 4) . "" . typ_pis($typ) . "" . $inc . "  vytvořen.";
		  mysql_query("UPDATE zem_dropdown SET porad='" . $porad . "' WHERE nazev='" . $zem ."';");
		 }
	}else{
	getSystemText("spatneudaje", $_SESSION['message_set']);
}

?>
								</div>
							</div>
						</div>
						<div class="module-foot">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
<?php


}else{ 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php getSystemText("registrace", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="index.php">
			  		UMSE Banka
			  	</a>
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" action="?reg" method="POST">
						<div class="module-head">
							<h3>Vytvořit účet</h3>
						</div>
						<div class="module-body">
              <?php zeme_menu(); ?>
							<div class="control-group">
								<div class="controls row-fluid">
                	<label class="control-label" for="inputPassword"><?php getSystemText("pin", $_SESSION['message_set']); ?></label>
									<input class="span12" type="password" id="inputPassword" name="pin" placeholder="<?php getSystemText("pin", $_SESSION['message_set']); ?>">
								</div>
							</div>
              <div class="control-group">
								<div class="controls row-fluid">
                	<label class="control-label" for="inputInc"><?php getSystemText("inicialy", $_SESSION['message_set']); ?></label>
									<input class="span12" type="text" id="inputInc" name="inicialy" placeholder="XX">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right"><?php getSystemText("vytvorit", $_SESSION['message_set']); ?></button>
									<label class="checkbox">
										<input type="checkbox" name="firem" value="1"> <?php getSystemText("ucet_organisace", $_SESSION['message_set']); ?>
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2014 UMSE & Aerosoft, Theme Edmin - EGrappler.com </b> All rights reserved.
		</div>
	</div>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
<?php
}
 mysql_close(); 
?>