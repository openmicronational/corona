<?php
include "func.php";
database_open();

if($_SESSION['log'] != 1)
{
if($_GET['action'] == "log")
{
$ucet = htmlspecialchars($_POST['ucet'], ENT_QUOTES);
$pin = htmlspecialchars($_POST['pin'], ENT_QUOTES);
if(mb_strlen($pin,'UTF-8') == 4 && is_numeric($pin) && mb_strlen($ucet,'UTF-8') == 10 && !is_numeric($ucet))
{
 if(logIn($ucet, $pin))
 {
  $_SESSION['log'] = 1; 
  $_SESSION['ucet'] = $ucet;
  //$_SESSION['zem'] = getUsrProperty($id, $prop);
  $_SESSION['id'] = userid($ucet);
  header("Location: index.php");
 }

}
}else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UMSE Banka - Přihlášení</title>
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

				<div class="nav-collapse collapse navbar-inverse-collapse">
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="POST" action="?action=log">
						<div class="module-head">
							<h3>Přihlašte se, prosím</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="ucet" name="ucet" placeholder="Účet">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" id="pin" name="pin" placeholder="PIN">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right">Přihlásit se</button>
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



}else{

if($_GET['action'] == "logoff")
{
session_destroy();
header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Corona - UMSE Bank</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php">UMSE Bank </a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Váš účet</a></li>
                                    <li><a href="#">Nastevení účtu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="?action=logoff">Odhlásit se</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.nav-collapse -->
                </div>
            </div>
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <?php sidebar($_SESSION['userlevel']); ?>
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="transakce.php" class="btn-box big span4"><i class=" icon-random"></i><b><?php echo transakce24($_SESSION['id']); ?></b>
                                        <p class="text-muted">
                                            Transakcí za poslední den</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b>1</b>
                                        <p class="text-muted">
                                            Konto</p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-money"></i><b><?php echo getUsrProperty($_SESSION['id'], "balance"); ?></b>
                                        <p class="text-muted">
                                            Coron</p>
                                    </a>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <div class="span8">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-envelope"></i><b>Zprávy</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b>Konta</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-exchange"></i><b>Vytvořit transakci</b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-save"></i><b>Terminály</b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-bullhorn"></i><b></b>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                            <!--/.module-->
                            <div class="module hide">
                                <div class="module-head">
                                    <h3>
                                        Adjust Budget Range</h3>
                                </div>
                                <div class="module-body">
                                    <div class="form-inline clearfix">
                                        <a href="#" class="btn pull-right">Update</a>
                                        <label for="amount">
                                            Price range:</label>
                                        &nbsp;
                                        <input type="text" id="amount" class="input-" />
                                    </div>
                                    <hr />
                                    <div class="slider-range">
                                    </div>
                                </div>
                            </div>
                            <div class="module">
                                <div class="module-head">
                                    <h3>
                                        DataTables</h3>
                                </div>
                                <div class="module-body table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>
                                                   Akce 
                                                </th>
                                                <th>
                                                    Kdy
                                                </th>
                                                <th>
                                                    Od/Komu
                                                </th>
                                                <th>
                                                    Kolik
                                                </th>
                                                <th>
                                                    Komentář
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                          transakce($_SESSION['id']);
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                   Typ 
                                                </th>
                                                <th>
                                                    Kdy
                                                </th>
                                                <th>
                                                    Od/Komu
                                                </th>
                                                <th>
                                                    Kolik
                                                </th>
                                                <th>
                                                    Komentář
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!--/.module-->
                        </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
                </div>
            </div>
            <!--/.container-->
        </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2014 UMSE & Aerosoft, Theme Edmin - EGrappler.com </b> All rights reserved.
            </div>
        </div>
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      
    </body>
<?php
}
 mysql_close(); 
?>