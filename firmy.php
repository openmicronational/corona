<?php
include "func.php";
database_open();
if(isset($_SESSION['log'])){
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
                    <?php sidebar($_SESSION['userlevel']);
                    if(hasCompany($_SESSION['id']))
                    {
                    if(isset($_GET["edit"]))
                    {
                        if(isset($_POST["nazev"]) || isset($_POST["zkratka"]))
                        {
                            ?>
                            <div class="span9">
                            <div class="content">
                                <div class="module message">
                                    <div class="module-head">
                                        <h3>Upravit firmu</h3>
                                    </div>
                            <div class="module-body table">
                            <?php
                            $id = getCmpPropertyBySpravce($_SESSION['id'], "id");
                            $nazev = htmlspecialchars($_POST["nazev"], ENT_QUOTES);
                            $zkratka = htmlspecialchars($_POST["zkratka"], ENT_QUOTES);
                            if(mb_strlen($zkratka) != 3) $zkratka = getCmpProperty($id, "zkratka");
                            if($nazev == "") $nazev = getCmpProperty($id, "nazev");

                            if($nazev != getCmpProperty($id, "nazev") || $zkratka != getCmpProperty($id, "zkratka"))
                            {
                                if(prevod(getUserNameFromId($_SESSION["id"]), "UMS0001FUB", 1, 0, 1555, 1555, "Změna údajú pro firmu " . $nazev))
                                { mysql_query("UPDATE `firma` SET `nazev`='" . $nazev . "', `posledni_uprava`=NOW(),`zkratka`='" . $zkratka . "' WHERE id=" . $id ."") or die(mysql_error());
                                  echo "Změna byla provedena";
                                }else{
                                    echo "Změna nebyla provedena z důvodů nedostatku peněz na účtu.";
                                }
                            } else echo "Změna nebyla provedena z důvodů shody nových údajů s předešlými.";
                            ?>
                                    </div>
                                    <div class="module-foot">
                                    </div>
                                </div>
                            </div>
                            <!--/.content-->
                        </div>

                            <?php
                        }else{
                        $id = getCmpPropertyBySpravce($_SESSION['id'], "id");
                        ?>
                            <div class="span9">
                            <div class="content">
                                <div class="module message">
                                    <div class="module-head">
                                        <h3>Upravit firmu</h3>
                                    </div>
                                    <form action="?edit" method="POST">
                                    <div class="module-body table">
                                        <div class="control-group">
                                            <label class="control-label" for="nazev">Název subjektu</label>
                                            <div class="controls row-fluid">
                                                <input class="span12" type="text" id="nazev" name="nazev" placeholder="Plný název" value="<?php echo getCmpProperty($id, "nazev"); ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="nazev">Zkratka (tři písmena)</label>
                                            <div class="controls row-fluid">
                                                <input class="span12" type="text" id="zkratka" name="zkratka" placeholder="XXX" value="<?php echo getCmpProperty($id, "zkratka"); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="module-foot">
                                        <div class="control-group">
                                            Upozornění: Každá změna zápisu stojí 1 ₡!
                                            <div class="controls clearfix">
                                                <button type="submit" class="btn btn-primary pull-right">Zaznamenat změnu</button>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            <!--/.content-->
                        </div>
                        <?php
                        }
                    }else{
                    $fid = getCmpPropertyBySpravce($_SESSION['id'], "id");
                    ?>
				<!--/.span3-->
                    <!--/.span3-->
                    <div class="span9">
                        <div class="content">
                            <div class="btn-controls">
                                <div class="btn-box-row row-fluid">
                                    <a href="?edit" class="btn-box big span4"><i class=" icon-random"></i><b>Upravit firmu</b>
                                        <p class="text-muted"> </p>
                                    </a><a href="?firmy" class="btn-box big span4"><i class="icon-user"></i><b>Prohlížet firmy</b>
                                        <p class="text-muted"></p>
                                    </a><a href="?akcie" class="btn-box big span4"><i class="icon-money"></i><b>Prohlížet akcie</b>
                                        <p class="text-muted"></p>
                                    </a>
                                </div>
                            </div>
                            <div class="module message">
                                <div class="module-head">
                                    <h3>Akcionáři <?php echo getCmpProperty($fid, "nazev"); ?></h3>
                                </div>
                                <div class="module-body table">
                                    <table class="table table-message">
                                    <thead>
                                            <tr class="heading">
                                                <td class="cell-title">
                                                    Jméno
                                                </td>
                                                <td>
                                                    Kdy
                                                </td>
                                                <td>
                                                    Počet akcií
                                                </td>
                                                <td>
                                                    ( % )
                                                </td>
                                                <td>
                                                    Koupil za
                                                </td>
                                                <td>
                                                    Prodává
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $query = mysql_query("SELECT * FROM akcie WHERE firmy=" . $fid . " AND pocet > 0");
                                        while($row = mysql_fetch_assoc($query))
                                        {
                                            $row["vlastnik"] = ($row["vlastnik"] == $_SESSION["id"])?"Vy":getUserNameFromId($row["vlastnik"]);
                                            $row["prodej"] = ($row["prodej"])?"Ano":"Ne";
                                            echo "<td>" . $row["vlastnik"] . "</td>";
                                            echo "<td>" . phpdateeu($row["koupil"]) . "</td>";
                                            echo "<td>" . $row["pocet"] . "</td>";
                                            echo "<td>" . (($row["pocet"]/100000)*100) . "</td>";
                                            echo "<td>" . $row["kup_hodnota"] . "</td>";
                                            echo "<td>" . $row["prodej"] . "</td>";
                                        }
                                        ?>
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
                    <?php 
                    }
                }else if($_GET["firmy"]){
                        if(isset($_POST["zkratka"]))
                        {
                            $zkratka = htmlspecialchars($_POST["zkratka"]);
                            $nazev = htmlspecialchars($_POST["nazev"]);
                            $query = mysql_query("SELECT * FROM firmy WHERE zkratka LIKE '" . $zkratka . "' OR nazev LIKE '" . $nazev . "'");
                            ?>
                        <div class="span9">
                        <div class="content">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>Hledání firmy</h3>
                                </div>
                                <div class="module-body table">
                                    <table class="table table-message">
                                    <thead>
                                            <tr class="heading">
                                                <td class="cell-title">
                                                    Jméno
                                                </td>
                                                <td>
                                                    Zkratka
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        while($row = mysql_fetch_assoc($query))
                                        {
                                            echo "<td>" . $row["nazev"] . "</td>";
                                            echo "<td>" . phpdateeu($row["zkratka"]) . "</td>";
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="module-foot">
                                </div>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>-/.content-->
                    </div>
                            <?php
                        }else{
                            ?>
                        <div class="span9">
                        <div class="content">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>Hledat firmu v systému</h3>
                                </div>
                                <form action="?firmy" method="POST">
                                <div class="module-body table">
                                    <div class="control-group">
                                        <label class="control-label" for="nazev">Název subjektu</label>
                                        <div class="controls row-fluid">
                                            <input class="span12" type="text" id="nazev" name="nazev" placeholder="Plný název">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="nazev">Zkratka (tři písmena)</label>
                                        <div class="controls row-fluid">
                                            <input class="span12" type="text" id="zkratka" name="zkratka" placeholder="XXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="module-foot">
                                    <div class="control-group">
                                        <div class="controls clearfix">
                                            <button type="submit" class="btn btn-primary pull-right">Hledat</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <?php
                        }

                }else{
                    if(isset($_GET["mk"]) && $_POST["nazev"] != "" && $_POST["zkratka"] != "")
                    {
                        if(mb_strlen($_POST["zkratka"], "utf-8") == 3)
                        {
                        $spravce = $_SESSION["id"];
                        $zeme = getUsrProperty($spravce, "zem");
                        $nazev = htmlspecialchars($_POST["nazev"], ENT_QUOTES);
                        $zkratka = htmlspecialchars($_POST["zkratka"], ENT_QUOTES);
                        $query = "INSERT INTO `firma`(`spravce`, `zeme`, `nazev`, `pridani`, `zkratka`) VALUES (" . $spravce . ",'" . $zeme . "', '" . $nazev . "', NOW(), '" . $zkratka . "')";
                        mysql_query($query) or die(mysql_error());
                        $cid = getCmpPropertyBySpravce($spravce, "id");
                        $query = "INSERT INTO `akcie`(`pocet`, `vlastnik`, `koupil`, `kup_hodnota`, `prod_hodnota`, `prodej`, `firmy`) VALUES (100000," . $spravce . ", NOW(), 10, 10, 0, " . $cid .")";
                        mysql_query($query) or die(mysql_error());
                        }
                    }else{
                    ?>
                    <div class="span9">
                        <div class="content">
                            <div class="module message">
                                <div class="module-head">
                                    <h3>Zavést firmu do systému</h3>
                                </div>
                                <form action="?mk" method="POST">
                                <div class="module-body table">
                                    <div class="control-group">
                                        <label class="control-label" for="nazev">Název subjektu</label>
                                        <div class="controls row-fluid">
                                            <input class="span12" type="text" id="nazev" name="nazev" placeholder="Plný název">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label" for="nazev">Zkratka (tři písmena)</label>
                                        <div class="controls row-fluid">
                                            <input class="span12" type="text" id="zkratka" name="zkratka" placeholder="XXX">
                                        </div>
                                    </div>
                                </div>
                                <div class="module-foot">
                                    <div class="control-group">
                                        Zavedení firmy do systému je zdarma.
                                        <div class="controls clearfix">
                                            <button type="submit" class="btn btn-primary pull-right">Zaznamenat</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!--/.content-->
                    </div>
                    <?php 
                    }
                } ?>
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
?>