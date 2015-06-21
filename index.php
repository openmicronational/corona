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
  $_SESSION['userlevel'] = getUsrProperty($_SESSION['id'], "usertype");
  $_SESSION['nastaveni_id'] = getUsrProperty($_SESSION['id'], "naducet");
  if(isset($_GET['l']))
  {
  $_SESSION['message_set'] = htmlspecialchars($_GET['l']);
  }else{
  $_SESSION['message_set'] = getLngProperty(getUsrTProperty($_SESSION['id'], "jazyk"), "message_set");
  }
  header("Location: index.php");
 }

}
}else{
if(isset($_GET['l']))
{
  $_SESSION['message_set'] = getLngProperty(htmlspecialchars($_GET['l']), "message_set");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php getSystemText("umseprihlas", $_SESSION['message_set']); ?></title>
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

				<div class="nav-collapse collapse navbar-inverse-collapse">
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="POST" action="?action=log<?php if(isset($_GET['l']) && $_GET['l'] != "") echo "&l=" . $_GET['l']; ?>">
						<div class="module-head">
							<h3><?php getSystemText("prihlasteprosim", $_SESSION['message_set']); ?></h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="ucet" name="ucet" placeholder="<?php getSystemText("ucet", $_SESSION['message_set']); ?>">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" id="pin" name="pin" placeholder="<?php getSystemText("pin", $_SESSION['message_set']); ?>">
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right"><?php getSystemText("prihlasit_se", $_SESSION['message_set']); ?></button>
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
else if($_GET['action'] == "settings")
{
?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php getSystemText("nastaveni", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php"><?php getSystemText("umsebanka", $_SESSION['message_set']); ?></a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><?php getSystemText("vas_ucet", $_SESSION['message_set']); ?></a></li>
                                    <li><a href="#"><?php getSystemText("nastaveni", $_SESSION['message_set']); ?></a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?action=logoff"><?php getSystemText("odhlas", $_SESSION['message_set']); ?></a></li>
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
                        <form class="form-horizontal row-fluid" action="?action=settings" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3><?php getSystemText("nastaveni_uctu", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">
                                <?php
                                  if(isset($_POST['pin']))
                                  {
                                    $id = $_SESSION['id'];
                                    $pin = htmlspecialchars($_POST['pin'], ENT_QUOTES);
                                    $jmeno = htmlspecialchars($_POST['jmeno'], ENT_QUOTES);
                                    $jazyk = htmlspecialchars($_POST['jazyk'], ENT_QUOTES);
                                    $logovat = htmlspecialchars($_POST['logovat'], ENT_QUOTES);
                                    $bezp = hash("sha256", htmlspecialchars($_POST['bezp'], ENT_QUOTES));
                                    $_SESSION['message_set'] = getLngProperty($jazyk, "message_set");
                                    if(is_numeric($pin) && $pin != 0)
                                    {
                                      if(getUsrProperty($id, "pin") == hash("sha256", $pin))
                                        {
                                          if(mysql_num_rows(mysql_query('SELECT * FROM nastaveni WHERE ucet="'. $id . '"')) == 0)
                                          {
                                          echo mysql_num_rows(mysql_query('SELECT * FROM nastaveni WHERE ucet="'. $id . '"'));
                                              mysql_query("INSERT INTO nastaveni (ucet, jmeno, jazyk, logovat, bezpecnostni_kod) VALUES ('$id','$jmeno','$jazyk','$logovat', '$bezp');") or die(mysql_error());
                                              echo "PRVNI_NASTAVENI_PROVEDENO";
                                          }else{
                                          
                                          mysql_query("UPDATE nastaveni SET jmeno = '$jmeno', jazyk = '$jazyk', logovat = '$logovat', bezpecnostni_kod = '$bezp' WHERE ucet='$id';") or die(mysql_error());
                                          echo "UPDATE nastaveni SET jmeno = '$jmeno', jazyk = '$jazyk', logovat = '$logovat', bezpecnostni_kod = '$bezp' WHERE ucet='$id';";
                                          echo "NASTAVENI_UPRAVENO";
                                          }
                                        } 
                                    }else
                                    {
                                    
                                    }
                                  }else{
                                ?>
                                <br>
										            <div class="control-group">
            											<label class="control-label" for="jmeno"><?php getSystemText("jmeno", $_SESSION['message_set']); ?></label>
              											<div class="controls">
              												<input type="text" id="jmeno" placeholder="Jméno Příjmení" name="jmeno" class="span8" value="<?php echo getUsrT2Property($_SESSION['id'], "jmeno"); ?>">
              												<span class="help-inline"><?php getSystemText("pseudo", $_SESSION['message_set']); ?></span>
              											</div>
              									</div>
                                
                                <?php lng_menu(); ?>
                                
                                <div class="control-group">
            											<label class="control-label" for="bezp"><?php getSystemText("bezpecnostni_kod", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="bezp" type="password" placeholder="XXXXXXX" name="bezp">       
            												</div>
            											</div>
            										</div>

                  							<div class="control-group">
                  									<label class="checkbox">
                  										<input type="checkbox" name="logovat" value="1"> <?php getSystemText("logovat", $_SESSION['message_set']); ?>
                  									</label>
                  							</div>
                                
                                <div class="control-group">
            											<label class="control-label" for="pin"><?php getSystemText("pin", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="pin" type="password" placeholder="XXXX" name="pin">       
            												</div>
            											</div>
            										</div>
                                
                                <?php } ?>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls">
            											<button type="submit" class="btn btn-primary pull-right"><?php getSystemText("zmenit", $_SESSION['message_set']); ?></button>
            											</div>
            										</div>
                                </div>
                            </div>
                        </form>
                        <!--/.content-->

                    </div>
                    <!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
  </div>
	<div class="footer">
    <div class="container">
			<b class="copyright">&copy; 2014 UMSE & Aerosoft, Theme Edmin - EGrappler.com </b> All rights reserved.
		</div>
	</div>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.table-message tbody tr').click(
				function() 
				{
					$(this).toggleClass('resolved');
				}
			);
		} );
	</script>
</body>
<?php

}else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
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
                        <i class="icon-reorder shaded"></i></a><a class="brand" href="index.php"><?php getSystemText("umsebanka", $_SESSION['message_set']); ?></a>
                    <div class="nav-collapse collapse navbar-inverse-collapse">
                        <ul class="nav pull-right">
                            <li class="nav-user dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="" class="nav-avatar" />
                                <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><?php getSystemText("vas_ucet", $_SESSION['message_set']); ?></a></li>
                                    <li><a href="index.php?action=settings"><?php getSystemText("nastaveni_uctu", $_SESSION['message_set']); ?></a></li>
                                    <li class="divider"></li>
                                    <li><a href="?action=logoff"><?php getSystemText("odhlas", $_SESSION['message_set']); ?></a></li>
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
                                            <?php getSystemText("transakce24", $_SESSION['message_set']); ?></p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-user"></i><b>1</b>
                                        <p class="text-muted">
                                            <?php getSystemText("konto", $_SESSION['message_set']); ?></p>
                                    </a><a href="#" class="btn-box big span4"><i class="icon-money"></i><b><?php echo getUsrProperty($_SESSION['id'], "balance"); ?></b>
                                        <p class="text-muted">
                                            <?php getSystemText("coron", $_SESSION['message_set']); ?></p>
                                    </a>
                                </div>
                                <div class="btn-box-row row-fluid">
                                    <div class="span8">
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="#" class="btn-box small span4"><i class="icon-envelope"></i><b><?php getSystemText("zpravy", $_SESSION['message_set']); ?></b>
                                                </a><a href="#" class="btn-box small span4"><i class="icon-group"></i><b><?php getSystemText("konta", $_SESSION['message_set']); ?></b>
                                                </a><a href="transakce2.php" class="btn-box small span4"><i class="icon-exchange"></i><b><?php getSystemText("vytvor_plan_trans", $_SESSION['message_set']); ?></b>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row-fluid">
                                            <div class="span12">
                                                <a href="terminal.php" class="btn-box small span4"><i class="icon-save"></i><b><?php getSystemText("terminaly", $_SESSION['message_set']); ?></b>
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
                                                  <?php getSystemText("akce", $_SESSION['message_set']); ?> 
                                                </th>
                                                <th>
                                                  <?php getSystemText("kdy", $_SESSION['message_set']); ?>
                                                </th>
                                                <th>
                                                  <?php getSystemText("od", $_SESSION['message_set']); ?>/<?php getSystemText("komu", $_SESSION['message_set']); ?>
                                                </th>
                                                <th>
                                                  <?php getSystemText("kolik", $_SESSION['message_set']); ?>
                                                </th>
                                                <th>
                                                  <?php getSystemText("komentar", $_SESSION['message_set']); ?>
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
                                                   <?php getSystemText("akce", $_SESSION['message_set']); ?>  
                                                </th>
                                                <th>
                                                    <?php getSystemText("kdy", $_SESSION['message_set']); ?>
                                                </th>
                                                <th>
                                                    <?php getSystemText("od", $_SESSION['message_set']); ?>/<?php getSystemText("komu", $_SESSION['message_set']); ?>
                                                </th>
                                                <th>
                                                    <?php getSystemText("kolik", $_SESSION['message_set']); ?>
                                                </th>
                                                <th>
                                                    <?php getSystemText("komentar", $_SESSION['message_set']); ?>
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
}
 mysql_close(); 
?>