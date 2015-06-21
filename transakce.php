<?php
include "func.php";
database_open();
if(isset($_SESSION['log']))
{
if($_GET['action'] == "transakce")
{
$_POST['ucet'] = htmlspecialchars($_POST['ucet'], ENT_QUOTES);
$_POST['castka'] = htmlspecialchars($_POST['castka'], ENT_QUOTES);
$_POST['var'] = leadingZeros(htmlspecialchars($_POST['var'], ENT_QUOTES), 4);
$_POST['spec'] = leadingZeros(htmlspecialchars($_POST['spec'], ENT_QUOTES), 4);
$_POST['komentar'] = htmlspecialchars($_POST['komentar'], ENT_QUOTES);

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
                        <form class="form-horizontal row-fluid" action="?action=transakce2" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        <?php getSystemText("transakce", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">  
                                <br>
                                <div class="control-group">
                                <div style="margin-left:10px;">
                                <table class="table">
                  								  <thead>
                  									<tr>
                  									  <th><?php getSystemText("prijemce", $_SESSION['message_set']); ?></th>
                  									  <th><?php getSystemText("castka", $_SESSION['message_set']); ?></th>
                  									  <th><?php getSystemText("variabilni_symbol", $_SESSION['message_set']); ?></th>
                  									  <th><?php getSystemText("specialni_symbol", $_SESSION['message_set']); ?></th>
                                      <th><?php getSystemText("komentar", $_SESSION['message_set']); ?></th>
                  									</tr>
                  								  </thead>
                  								  <tbody>
                  									<tr>
                  									  <td><?php echo $_POST['ucet']; ?></td>
                  									  <td><?php echo $_POST['castka']; ?></td>
                  									  <td><?php echo $_POST['var']; ?></td>
                  									  <td><?php echo $_POST['spec']; ?></td>
                                      <td><?php echo $_POST['komentar']; ?></td>
                  								  </tbody>
                  							</table>
                                </div>
                                </div>
                                <div class="control-group">
                                <?php if($_POST["castka"] > 1000){ ?>
            											<label class="control-label" for="pin"><?php getSystemText("pin", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="pin" type="password" placeholder="0000" name="pin">       
            												</div>
            											</div>
            										</div>
                                <?php } ?>
                                <input type="hidden" name="ucet" value="<?php echo $_POST['ucet']; ?>">
                                <input type="hidden" name="castka" value="<?php echo $_POST['castka']; ?>">
                                <input type="hidden" name="var" value="<?php echo $_POST['var']; ?>">
                                <input type="hidden" name="spec" value="<?php echo $_POST['spec']; ?>">
                                <input type="hidden" name="komentar" value="<?php echo $_POST['komentar']; ?>">
                                                                
                                <br>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls">
            											<button type="submit" class="btn btn-primary pull-right"><?php getSystemText("odeslat", $_SESSION['message_set']); ?></button>
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
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        <?php getSystemText("transakce", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">
<?php

$ucet = htmlspecialchars($_POST['ucet'], ENT_QUOTES);
$castka = htmlspecialchars($_POST['castka'], ENT_QUOTES);
$var = leadingZeros(htmlspecialchars($_POST['var'], ENT_QUOTES), 4);
$spec = leadingZeros(htmlspecialchars($_POST['spec'], ENT_QUOTES), 4);
$komentar = htmlspecialchars($_POST['komentar'], ENT_QUOTES);
$pin = htmlspecialchars($_POST['pin'], ENT_QUOTES);
if(is_numeric($castka) && is_numeric($var) && is_numeric($spec) && $castka > 0){
if(prevod(getUserNameFromId($_SESSION['id']), $ucet, $castka, $pin, $var, $spec, $komentar))
{
echo '<div class="alert alert-success"><strong>'; getSystemText("oznameni", $_SESSION['message_set']); echo '</strong> '; getSystemText("platba_zda", $_SESSION['message_set']);   echo '</div>';
}else{
echo '<div class="alert alert-error"><strong>'; getSystemText("chyba", $_SESSION['message_set']);  echo '</strong>'; getSystemText("platba_nez2", $_SESSION['message_set']); echo ' </div>';
}
} else echo '<div class="alert alert-error"><strong>'; getSystemText("chyba", $_SESSION['message_set']); echo '</strong>'; getSystemText("platba_nez3", $_SESSION['message_set']); echo '</div>';
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
}else if($_GET['action'] == "lookup")
{
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
if(getTransakceProperty($id,'prijemce') == $_SESSION['id'] || getTransakceProperty($id,'odesilatel') == $_SESSION['id'])
{
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
                            <div class="module message">
                                <div class="module-head">
                                  <h3><?php getSystemText("transakce", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">  
                                <br>
                                <div class="control-group">
                                <div style="margin-left:10px;">
                                <table class="table">
                  								  <thead>
                  									<tr>
                  									  <th><?php getSystemText("prijemce", $_SESSION['message_set']); ?></th>
                  									  <th><?php getSystemText("castka", $_SESSION['message_set']); ?></th>
                  									  <th><?php getSystemText("variabilni_symbol", $_SESSION['message_set']); ?></th>
                  									  <th><?php getSystemText("specialni_symbol", $_SESSION['message_set']); ?></th>
                                      <th><?php getSystemText("komentar", $_SESSION['message_set']); ?></th>
                  									</tr>
                  								  </thead>
                  								  <tbody>
                  									<tr>
                  									  <td><?php echo getUserNameFromId(getTransakceProperty($id,'odesilatel')); ?></td>
                                      <td><?php echo getUserNameFromId(getTransakceProperty($id,'prijemce')); ?></td>
                  									  <td><?php echo getTransakceProperty($id,'castka'); ?></td>
                  									  <td><?php echo getTransakceProperty($id,'variabilni_symbol'); ?></td>
                  									  <td><?php echo getTransakceProperty($id,'specialni_symbol'); ?></td>
                                      <td><?php echo getTransakceProperty($id,'komentar'); ?></td>
                                    </tr>
                  								  </tbody>
                                    <tfoot>
                                      <tr>
                                       <td colspan="6"><?php echo "<center>Transakce byla provedena <b>" . phpdateeu(getTransakceProperty($id,'kdy')) . ".</b></center>"; ?></td>
                                      </tr>
                                    </tfoot>
                  							</table>
                              
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
<html>
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
                        <form class="form-horizontal row-fluid" action="?action=transakce" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        <?php getSystemText("transakce", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">
                                
                                <br>
										            <div class="control-group">
            											<label class="control-label" for="prvni"><?php getSystemText("ucet_prijemce", $_SESSION['message_set']); ?></label>
              											<div class="controls">
              												<input type="text" id="prvni" placeholder="XXXXXXXXXX" name="ucet" class="span8">
              												<span class="help-inline"><?php getSystemText("std_format", $_SESSION['message_set']); ?></span>
              											</div>
              									</div>
                                
                                <div class="control-group">
          											<label class="control-label" for="castka"><?php getSystemText("castka", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<div class="input-append">
            													<input type="text" placeholder="10.000" id="castka" class="span8" name="castka"><span class="add-on"><?php getSystemText("corona_symbol", $_SESSION['message_set']); ?></span>
            												</div>
            											</div>
          										  </div>
                                
                                <div class="control-group">
            											<label class="control-label" for="var"><?php getSystemText("variabilni_symbol", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="var" type="text" placeholder="0000" name="var">       
            												</div>
            											</div>
            										</div>
                                                                
                                <div class="control-group">
            											<label class="control-label" for="spec"><?php getSystemText("specialni_symbol", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<div class="input-prepend">
            													<span class="add-on">#</span><input class="span8" id="spec" type="text" placeholder="0000" name="spec">       
            												</div>
            											</div>
            										</div>
                                
                                <div class="control-group">
            											<label class="control-label" for="komentar"><?php getSystemText("komentar", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<textarea class="span8" rows="5" name="komentar" id="komentar"></textarea>
            											</div>
            									 </div>
                                
                                <br>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls">
            											<button type="submit" class="btn btn-primary pull-right"><?php getSystemText("odeslat", $_SESSION['message_set']); ?></button>
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