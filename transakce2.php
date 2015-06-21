<?php
include "func.php";
database_open();
if(isset($_SESSION['log']))
{
if($_GET['action'] == "transakce")
{
$_POST['castka'] = htmlspecialchars($_POST['castka'], ENT_QUOTES);
$_POST['var'] = leadingZeros(htmlspecialchars($_POST['var'], ENT_QUOTES), 4);
$_POST['spec'] = leadingZeros(htmlspecialchars($_POST['spec'], ENT_QUOTES), 4);
$_POST['komentar'] = htmlspecialchars($_POST['komentar'], ENT_QUOTES);

?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plánovaná transakce - UMSE Bank</title>
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
                                    <li><a href="#">Nastavení účtu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?action=logoff">Odhlásit se</a></li>
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
<?php 
sidebar($_SESSION['userlevel']); ?>
				<!--/.span3-->


			<div class="span9">
                        <div class="content">
                        <form class="form-horizontal row-fluid" action="?action=transakce2" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        Plánovaná transakce</h3>
                                </div>
                                <div class="module-body">  
                                <br>
                                <div class="control-group">
                                <div style="margin-left:10px;">
                                <table class="table">
                  								  <thead>
                  									<tr>
                  									  <th>Částka</th>
                  									  <th>Variabilní symbol</th>
                  									  <th>Speciální symbol</th>
                                      <th>Komentář</th>
                                      <th>Opakovatelné</th>
                  									</tr>
                  								  </thead>
                  								  <tbody>
                  									<tr>
                  									  <td><?php echo $_POST['castka']; ?></td>
                  									  <td><?php echo $_POST['var']; ?></td>
                  									  <td><?php echo $_POST['spec']; ?></td>
                                      <td><?php echo $_POST['komentar']; ?></td>
                                      <td><?php echo $_POST['opak']; ?></td>
                  								  </tbody>
                  							</table>
                                <center>Po zaplacení této částky budete informováni.</center>
                                </div>
                                </div>
                                
                                <input type="hidden" name="castka" value="<?php echo $_POST['castka']; ?>">
                                <input type="hidden" name="var" value="<?php echo $_POST['var']; ?>">
                                <input type="hidden" name="spec" value="<?php echo $_POST['spec']; ?>">
                                <input type="hidden" name="komentar" value="<?php echo $_POST['komentar']; ?>">
                                <input type="hidden" name="opak" value="<?php echo $_POST['opak']; ?>">                                
                                <br>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls">
            											<button type="submit" class="btn btn-primary pull-right">Vytvořit</button>
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
}else if($_GET['action'] == "transakce2"){
?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Transakce - UMSE Bank</title>
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
                                    <li><a href="#">Nastavení účtu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?action=logoff">Odhlásit se</a></li>
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
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        Plánovaná transakce</h3>
                                </div>
                                <div class="module-body">
<?php

$castka = htmlspecialchars($_POST['castka'], ENT_QUOTES);
$var = leadingZeros(htmlspecialchars($_POST['var'], ENT_QUOTES), 4);
$spec = leadingZeros(htmlspecialchars($_POST['spec'], ENT_QUOTES), 4);
$komentar = htmlspecialchars($_POST['komentar'], ENT_QUOTES);
$opakovatelne = htmlspecialchars($_POST['opak'], ENT_QUOTES);
if(is_numeric($castka) && is_numeric($var) && is_numeric($spec) && $castka >= 0){
$identifikator = hash("crc32", "Transakce" . $castka . $spec . $var . $_SESSION['id'] . $opakovatelne . "|" . date("d.m.Y H:i:s")); 
if(createFutureTransaction($_SESSION['id'], $var, $spec, $komentar, $castka, $identifikator, $opakovatelne))
{
echo '<div class="alert alert-success"><strong>Oznámení</strong> Transakce vytvořena.</div>';
echo '<b>Transakce je dostupná na <a href="http://b.lxo.cz/transakce2.php?action=i&id='. $identifikator . '">http://b.lxo.cz/transakce2.php?i='. $identifikator . '</a> .';
}else{
echo '<div class="alert alert-error"><strong>Chyba</strong> Platba se nezdařila. Ujistěte se, že jste zadali správné údaje, částku a pin. Ujistěte se také, že systém není v plánované odstávce.</div>';
}
}
?>
<br>
										            
                                </div>
                            </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
  </div></div>
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
}else if($_GET['action'] == "cfm"){
?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plánovaná transakce - UMSE Bank</title>
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
                                    <li><a href="#">Nastavení účtu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?action=logoff">Odhlásit se</a></li>
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
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        Plánovaná transakce</h3>
                                </div>
                                <div class="module-body">
<?php

$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
$pin = htmlspecialchars($_POST['pin'], ENT_QUOTES);

if(is_numeric($pin)){
if(prevod(getUserNameFromId($_SESSION['id']), getUserNameFromId(getTransakce2Property($id,"komu")), getTransakce2Property($id,"kolik"), $pin, getTransakce2Property($id,"var"), getTransakce2Property($id,"spec"), getTransakce2Property($id,"komentar")))
{
echo '<div class="alert alert-success"><strong>Oznámení</strong> Platba se zdařila.</div>';
}else{
echo '<div class="alert alert-error"><strong>Chyba</strong> Platba se nezdařila. Ujistěte se, že jste zadali správné údaje, částku a pin. Ujistěte se také, že systém není v plánované odstávce.</div>';
}
}
?>
<br>
										            
                                </div>
                            </div>
                        <!--/.content-->
                    </div>
                    <!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->
  </div></div>
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
<?
}else if($_GET['action'] == "i"){
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
if(getTransakce2Property($id,'komu') != $_SESSION['id'])
{
?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plánovaná transakce - UMSE Bank</title>
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
                                    <li><a href="#">Nastavení účtu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?action=logoff">Odhlásit se</a></li>
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
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        Plánovaná transakce</h3>
                                </div>
                                <div class="module-body">  
                                <br>
                                <div class="control-group">
                                <div style="margin-left:10px;">
                                <table class="table">
                  								  <thead>
                  									<tr>
                                      <th>Příjemce</th>
                  									  <th>Částka</th>
                  									  <th>Variabilní symbol</th>
                  									  <th>Speciální symbol</th>
                                      <th>Komentář</th>
                  									</tr>
                  								  </thead>
                  								  <tbody>
                  									<tr>
                                      <td><?php echo getUserNameFromId(getTransakce2Property($id,'komu')); ?></td>
                  									  <td><?php echo getTransakce2Property($id,'kolik'); ?></td>
                  									  <td><?php echo leadingZeros(getTransakce2Property($id,'var'), 4); ?></td>
                  									  <td><?php echo leadingZeros(getTransakce2Property($id,'spec'), 4); ?></td>
                                      <td><?php echo getTransakce2Property($id,'komentar'); ?></td>
                                    </tr>
                  								  </tbody>
                                    <tfoot>
                                      <tr>
                                       <td colspan="5">                                       
                                       </td>
                                      </tr>
                                    </tfoot>
                  							</table>
                                <br>
                                <form class="form-vertical" action="?action=cfm&id=<?php echo $id; ?>" method="POST">
                                <div class="control-group">
                    						<label class="control-label" for="pin">PIN</label>
                    						<div class="controls">
                    						<div class="input-prepend">
                    						<span class="add-on">#</span><input style="height:20px;" id="pin" type="password" placeholder="0000" name="pin">       
                    						</div>
            										  <button type="submit" class="btn btn-primary">Odeslat</button>
                    						</div>
                    						</div>
                                </form>
                                
                                </div>
                                </div>
                          
                                <br>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls">
            											</div>
            										</div>
                                </div>
                            </div>
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
}
}else{
?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Plánovaná transakce - UMSE Bank</title>
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
                                    <li><a href="#">Nastavení účtu</a></li>
                                    <li class="divider"></li>
                                    <li><a href="index.php?action=logoff">Odhlásit se</a></li>
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
                        <form class="form-horizontal row-fluid" action="?action=transakce" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        Plánovaná transakce</h3>
                                </div>
                                <div class="module-body">
                                
                                <br>
                                
                                <div class="control-group">
          											<label class="control-label" for="castka">Částka</label>
            											<div class="controls">
            												<div class="input-append">
            													<input type="text" placeholder="10.000" id="castka" class="span8" name="castka"><span class="add-on">₡</span>
            												</div>
                                    <span class="help-inline">Zadejte 0 pro vlastní částku</span>
            											</div>
          										  </div>
                                
                                <div class="control-group">
            											<label class="control-label" for="var">Variabilní symbol</label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="var" type="text" placeholder="0000" name="var">       
            												</div>
            											</div>
            										</div>
                                                                
                                <div class="control-group">
            											<label class="control-label" for="spec">Speciální symbol</label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="spec" type="text" placeholder="0000" name="spec">       
            												</div>
            											</div>
            										</div>
                                
                                <div class="control-group">
            											<label class="control-label" for="komentar">Komentář</label>
            											<div class="controls">
            												<textarea class="span8" rows="5" name="komentar" id="komentar"></textarea>
            											</div>
            									 </div>
                               
                      				<div class="control-group">
                              <div style="margin-left:20px;">
                      					<label class="checkbox">
                      						<input type="checkbox" name="opak" value="1"> Transakci možno opakovat
                      					</label>    
                              </div>
                      				</div>
                                
                                <br>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls">
            											<button type="submit" class="btn btn-primary pull-right">Vytvořit</button>
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
}
}else{
header("Location: index.php");
}
mysql_close();
?>