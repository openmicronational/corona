<?php
include "func.php";
database_open();
if(isset($_SESSION['log']))
{
if($_GET['action'] == "send")
{
echo $komu;
$komu = htmlspecialchars($_POST['komu'], ENT_QUOTES);
if(!is_numeric($komu))
{
 $komu = userid($komu);
}
$tema = htmlspecialchars($_POST['tema'], ENT_QUOTES);
$text = htmlspecialchars(nl2br($_POST['obsah']), ENT_QUOTES);
$replyto = htmlspecialchars($_POST['reply'], ENT_QUOTES);
?>
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php getSystemText("zpravy", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
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
                                    <li><a href="index.php?action=settings"><?php getSystemText("nastaveni", $_SESSION['message_set']); ?></a></li>
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
                                        Zprávy</h3>
                                </div>
                                <div class="module-body">
<?php
if(createMsg($_SESSION['id'], $komu, $tema, $text, 0, $replyto))
{
 echo '									<div class="alert alert-success">
										<button type="button" class="close" data-dismiss="alert">×</button>
										<strong>Zpráva odeslána</strong>
									</div>'; 
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
}else if($_GET['action'] == "read")
{
$id = htmlspecialchars($_GET['id'], ENT_QUOTES);
if(getMsgProperty($id,'od') == $_SESSION['id'] || getMsgProperty($id,'komu') == $_SESSION['id'])
{
MarkRead($id);
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php getSystemText("zpravy", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
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
                                    <li><a href="index.php?action=settings"><?php getSystemText("nastaveni", $_SESSION['message_set']); ?></a></li>
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
                                        <?php echo getMsgProperty($id, "nazev"); ?></h3>
                                </div>
                                <div class="module-body">  
                                <br>
                                <div class="control-group">
                                <div style="margin-left:10px;">
                                <blockquote> 
                                <p><?php echo htmlspecialchars_decode(getMsgProperty($id, "obsah"), ENT_QUOTES); ?></p>
                                <small><?php echo getUsrProperty(getMsgProperty($id, "od"), "jmeno"); ?></small> </blockquote>
                                </div>
                                </div>
                                <hr>
                                
                                <b>
                                <center>
                                <?php echo getUsrProperty(getMsgProperty($id, "od"), "jmeno"); ?> -->
                                <?php echo getUsrProperty(getMsgProperty($id, "komu"), "jmeno"); ?>
                  							(<?php echo phpdateeu(getMsgProperty($id, "kdy")); ?>)
                                </center>
                                </b>
                                <br>
                                </div>
                                
                                <div class="module-foot">
                                <div class="control-group">
            										<div class="controls clearfix">
                                <form action="zpravy.php?action=public&id=<?php echo $id; ?>" method="POST">
                                  <b><a href="zpravy.php">Zpět</a></b>
                                  <button type="submit" class="btn btn-primary pull-right"><?php getSystemText("zverejnit", $_SESSION['message_set']); ?></button>
                                </form> 
            											</div>
            										</div>
                                </div>
                            </div>
                        <!--/.content-->
                        
                           <form class="form-horizontal row-fluid" action="?action=send" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3><?php getSystemText("odpoved", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">
                                <input type="hidden" name="komu" value="<?php echo getMsgProperty($id, "od"); ?>">
                                <input type="hidden" name="reply" value="<?php echo $id; ?>">
                                <br>
										            <div class="control-group">
            											<label class="control-label" for="prvni"><?php getSystemText("tema", $_SESSION['message_set']); ?></label>
              											<div class="controls">
              												<input type="text" id="prvni" placeholder="" name="tema" class="span8" value="<?php echo "RE:" . getMsgProperty($id, "nazev"); ?>">
              											</div>
              									</div>
                                
                                <div class="control-group">
            											<label class="control-label" for="komentar"><?php getSystemText("text_zpravy", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<textarea class="span8" rows="5" name="obsah" id="komentar"></textarea>
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
}else if($_GET['action'] == "create")
{

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php getSystemText("zpravy", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
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
                                    <li><a href="index.php?action=settings"><?php getSystemText("nastaveni", $_SESSION['message_set']); ?></a></li>
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
                           <form class="form-horizontal row-fluid" action="?action=send" method="POST">
                            <div class="module message">
                                <div class="module-head">
                                    <h3><?php getSystemText("napsat_zpravu", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-body">
                                <div class="control-group">
            											<label class="control-label" for="komu"><?php getSystemText("prijemce", $_SESSION['message_set']); ?></label>
              											<div class="controls">
              												<input type="text" id="komu" placeholder="" name="komu" class="span8" value="">
              											</div>
              									</div>
                                <input type="hidden" name="reply" value="0">
                                <br>
										            <div class="control-group">
            											<label class="control-label" for="prvni"><?php getSystemText("tema", $_SESSION['message_set']); ?></label>
              											<div class="controls">
              												<input type="text" id="prvni" placeholder="" name="tema" class="span8" value="">
              											</div>
              									</div>
                                
                                <div class="control-group">
            											<label class="control-label" for="komentar"><?php getSystemText("text_zpravy", $_SESSION['message_set']); ?></label>
            											<div class="controls">
            												<textarea class="span8" rows="5" name="obsah" id="komentar"></textarea>
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
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php getSystemText("zpravy", $_SESSION['message_set']); ?> - <?php getSystemText("umsebanka", $_SESSION['message_set']); ?></title>
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
                                    <li><a href="index.php?action=settings"><?php getSystemText("nastaveni", $_SESSION['message_set']); ?></a></li>
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
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>
                                        <?php getSystemText("zpravy", $_SESSION['message_set']); ?></h3>
                                </div>
                                <div class="module-option clearfix">
                                    <div class="pull-left">
                                        <div class="btn-group">
                                            <button class="btn">
                                                <?php getSystemText("prijate", $_SESSION['message_set']); ?></button>
                                            <button class="btn dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="zpravy.php"><?php getSystemText("prijate", $_SESSION['message_set']); ?></a></li>
                                                <li><a href="zpravy.php?action=sent"><?php getSystemText("odeslane", $_SESSION['message_set']); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="pull-right">
                                        <a href="?action=create" class="btn btn-primary"><?php getSystemText("vytvorit_zpravu", $_SESSION['message_set']); ?></a>
                                    </div>
                                </div>
                                <div class="module-body table">
                                    <table class="table table-message">
                                    <thead>
                                            <tr class="heading">
                                                <td class="cell-icon">
                                                </td>
                                                <td class="cell-author hidden-phone hidden-tablet">
                                                    <?php getSystemText("od", $_SESSION['message_set']); ?>
                                                </td>
                                                <td class="cell-title">
                                                    <?php getSystemText("nazev", $_SESSION['message_set']); ?>
                                                </td>
                                                <td class="cell-time align-right">
                                                    <?php getSystemText("kdy", $_SESSION['message_set']); ?>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php MessageList(1, $_SESSION['id']); ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="module-foot">
                                </div>
                            </div>
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
                <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
            </div>
        </div>
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
<?php
}
}
mysql_close();
?>