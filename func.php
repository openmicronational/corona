<?php
session_start();

function database_open(){
$mysql = mysql_connect("server","user","password");
      mysql_select_db("database", $mysql);
      mysql_query("SET character_set_client=utf8");
      mysql_query("SET character_set_connection=utf8");
      mysql_query("SET character_set_results=utf8");
}
      
function getUsrProperty($id, $prop){
$result = mysql_query("SELECT * FROM usr WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getLngProperty($id, $prop){
$result = mysql_query("SELECT * FROM jazyky WHERE kod='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getCmpProperty($id, $prop){
$result = mysql_query("SELECT * FROM firma WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getCmpPropertyBySpravce($id, $prop){
$result = mysql_query("SELECT * FROM firma WHERE spravce='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getSystemText($name, $lang){
$result = mysql_query("SELECT * FROM systemove_zpravy WHERE nazev='$name' AND message_set='$lang';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
echo $runrows["obsah"];
}

function getRetText($name, $lang){
$result = mysql_query("SELECT * FROM systemove_zpravy WHERE nazev='$name' AND message_set='$lang';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows["obsah"];
}  

function getMsgProperty($id, $prop){
$result = mysql_query("SELECT * FROM zpravy WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getUsrTProperty($id, $prop){
$result = mysql_query("SELECT * FROM nastaveni WHERE ucet='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getUsrT2Property($id, $prop){
$result = mysql_query("SELECT * FROM nastaveni WHERE ucet='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 


function getZemProperty($zem, $prop){
$result = mysql_query("SELECT * FROM zem_dropdown WHERE nazev='$zem';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
}

function getTransakceProperty($id, $prop){
$result = mysql_query("SELECT * FROM transakce WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
}

function getLngPropertyFromId($id, $prop){
$result = mysql_query("SELECT * FROM jazyky WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
}

function getTransakce2Property($id, $prop){
$result = mysql_query("SELECT * FROM plan_transakce WHERE identifikator='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
}  

function hasCompany($uid)
{
  $result = mysql_query("SELECT * FROM firma WHERE spravce='$uid';") or die(mysql_error());
  if(mysql_num_rows($result) > 0) return true; 
  return false;
}           
      
function createUser($pin, $porad, $zem, $typ, $inicialy, $ulevel){
try{
  $pin = hash("sha256", $pin);
  mysql_query("INSERT INTO usr (pin, zem, porad, typ, inicialy, usertype) VALUES ('$pin','$zem','$porad','$typ', '$inicialy', '$ulevel')") or die(mysql_error());
  return true;
}catch (Exception $e){
  echo $e;
return false;
}
}

function zeme_menu()
{
echo '
										<div class="control-group">
											<label class="control-label" for="basicinput">Země</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="Vyberte zem" name="zem">
                        ';
$result = mysql_query('SELECT * FROM zem_dropdown WHERE dostupny="1"') or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) 
{
echo '<option value="' . $row['nazev'] . '">' . $row['cely'] . '</option>';
}                        
                        echo '
												</select>
											</div>
										</div>
';

}

function typ_platby($input, $odesilatel, $prijemce)
{
if($prijemce == $_SESSION['id'])
{
return '<b>' . $input . '</b>';
}else return '<i>-' . $input . '</i>';

}

function phpdateeu($date)
{
$datetime = strtotime($date);
return date("d.m.Y H:i:s", $datetime);
//přidat čas
}

function DateDiffStr($d1, $d2)
{
$datetime1 = new DateTime($d1);

$datetime2 = new DateTime($d2);

$difference = $datetime1->diff($datetime2);

return '          '.$difference->y.' '. getSystemText("roku", $_SESSION['message_set']) . ', ' 
                   .$difference->m.' '. getSystemText("mesicu", $_SESSION['message_set']) . ', ' 
                   .$difference->d.' ' . getSystemText("dnu", $_SESSION['message_set']);
}

function DateDiffD($d1, $d2)
{
$datetime1 = new DateTime($d1);

$datetime2 = new DateTime($d2);

$difference = $datetime1->diff($datetime2);

return $difference->d;
}

function leadingZeros($num,$numDigits) {
   return sprintf("%0".$numDigits."d",$num);
}

function getUserNameFromId($id)
{
$result = mysql_query("SELECT * FROM usr WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows['zem'] . leadingZeros($runrows['porad'], 4) . typ_pis($runrows['typ']) . $runrows['inicialy'];
}

function transakce($id)
{
$result = mysql_query("SELECT * FROM transakce WHERE odesilatel='$id' OR prijemce='$id' ORDER BY kdy DESC;") or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) 
{
echo '<tr class="gradeA">
        <td>
        <a class="icon-eye-open" href="transakce.php?action=lookup&id=' . $row['id'] .'"></a>
        </td>
        <td>
        ' . phpdateeu($row['kdy']) . '
        </td>
        <td>
        ';
        echo getUserNameFromId($row['odesilatel']);
        echo '/'; 
        echo getUserNameFromId($row['prijemce']);
        echo '
        </td>
        <td class="center">
        ' . typ_platby($row['castka'], $row['odesilatel'], $row['prijemce']) . '
        </td>
        <td class="center">
        ' . $row['komentar'] . '
        </td>
        </tr>';

}
}

function transakce24($id)
{
$result = mysql_query("SELECT * FROM transakce WHERE odesilatel='$id' OR prijemce='$id' ORDER BY kdy DESC;") or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) 
{
$d = DateDiffD($row['kdy'], date('Y-m-d H:i:s'));
if($d < 1 && $d > 1) $count++;
}
if($count == 0) return getSystemText("zadne", $_SESSION['message_set']);
return $count;
}



function typ_pis($input)
{
if($input == "P") return 0; 
if($input == "F") return 1; 
if($input == 0) return "P"; 
if($input == 1) return "F"; 
}

function logIn($input, $pin)
{
$zem = substr($input, 0, 3);
$poradi = ltrim(substr($input, 3, 4), '0');
$typ = typ_pis(substr($input, 7, 1));
$inc = substr($input, 8, 2);
//echo " " . $zem . " " . $poradi . " " . $typ . " " . $inc;
$result = mysql_query("SELECT * FROM usr WHERE zem='$zem' AND porad='$poradi' AND typ='$typ' AND inicialy='$inc';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
if(hash("sha256",$pin) == $runrows['pin']){ return true;} else {return false;}
}
 
function userid($input)
{
$zem = substr($input, 0, 3);
$poradi = ltrim(substr($input, 3, 4), '0');
$typ = typ_pis(substr($input, 7, 1));
$inc = substr($input, 8, 2);
$result = mysql_query("SELECT * FROM usr WHERE zem='$zem' AND porad='$poradi' AND typ='$typ' AND inicialy='$inc';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows['id'];
}

function prevod($od, $komu, $castka, $pin, $var, $spec, $komentar)
{
$zem1 = substr($komu, 0, 3);
$porad1 = ltrim(substr($komu, 3, 4), '0');
$typ1 = typ_pis(substr($komu, 7, 1));
$inic1 = substr($komu, 8, 2);
    $result = mysql_query("SELECT * FROM usr WHERE zem='$zem1' AND porad='$porad1' AND typ='$typ1' AND inicialy='$inic1';") or die(mysql_error());
    $num_rows = mysql_num_rows($result);
    if($num_rows == 1)
    {
      $runrows = mysql_fetch_assoc($result);
      $id1 = $runrows['id'];
      $zustatek1 = $runrows['balance'];
      $runrows = 0;
      $result = 0;
    }else{return false;}
    //2 = odesílatel, klient
    $zem2 = substr($od, 0, 3);
    $porad2 = ltrim(substr($od, 3, 4), '0');
    $typ2 = typ_pis(substr($od, 7, 1));
    $inic2 = substr($od, 8, 2);
    //UID
    $result = mysql_query("SELECT * FROM usr WHERE zem='$zem2' AND porad='$porad2' AND typ='$typ2' AND inicialy='$inic2';") or die(mysql_error());
    $num_rows = mysql_num_rows($result);
    if($num_rows == 1)
    {
      $runrows = mysql_fetch_assoc($result);
      $id2 = $runrows['id'];
      $zustatek2 = $runrows['balance'];
      $p = $runrows['pin'];
    }else{return false;}
    //další parametry
    $pin = hash("sha256", $pin); 
    if($zustatek2 >= $castka)
    {
      if($p == $pin || $castka < 1000)
      {
        $var_symbol = $var;
        $spec_symbol = $spec;
        $zustatek1 = $zustatek1 + $castka;
        $zustatek2 = $zustatek2 - $castka;
                
        $query = "UPDATE usr SET balance='" . $zustatek1 . "' WHERE id='" . $id1 ."';";
        mysql_query($query) or die(mysql_error());    
        
        $query = "UPDATE usr SET balance='" . $zustatek2 . "' WHERE id='" . $id2 ."';";
        mysql_query($query) or die(mysql_error());
        if($zem1 == $zem2) $mezinarodni = 0; else $mezinarodni = 1;
        mysql_query("INSERT INTO transakce (castka, odesilatel, prijemce, variabilni_symbol, komentar, kdy, mezinarodni, specialni_symbol) VALUES ('$castka','$id2','$id1','$var_symbol','$komentar', NOW(), '$mezinarodni', '$spec_symbol')") or die(mysql_error());
        
   
        return true;            
      } else return false; 
    }

} 

function createFutureTransaction($id, $var, $spec, $komentar, $kolik, $identifikator, $opakovatelne){
try{
  
  echo $id; echo "<br>" . $var; echo "<br>" . $spec; echo "<br>" . $komentar; echo "<br>" . $identifikator; echo "<br>" . $opakovatelne;
  mysql_query("INSERT INTO `plan_transakce` (`komu`, `kolik`, `komentar`, `var`, `spec`, `identifikator`, `opakovatelne`, `vytvoreno`) VALUES ($id, $kolik, '$komentar', $var, $spec, '$identifikator', $opakovatelne, NOW())")or die(mysql_error());
  return true;
}catch (Exception $e){
  echo $e;
return false;
}
}

function sidebar($usertype)
{
if($usertype == 1)
{
echo '
<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>' . getRetText("hlav", $_SESSION['message_set']) . '</a></li>
            <li><a href="transakce.php"><i class="menu-icon icon-bullhorn"></i>' . getRetText("transakce", $_SESSION['message_set']) . '</a></li>
            <li><a href="zpravy.php"><i class="menu-icon icon-inbox"></i>' . getRetText("zpravy", $_SESSION['message_set']) .'</a></li>
            <li><a href="akce.php"><i class="menu-icon icon-inbox"></i>'. getRetText("akce", $_SESSION['message_set']) . '</a></li>
            <li><a href="firmy.php"><i class="menu-icon icon-inbox"></i>'. getRetText("firmy", $_SESSION['message_set']) . '</a></li>
        </ul>
        <!--/.widget-nav-->

        <!--/.widget-nav-->
        <ul class="widget widget-menu unstyled">
            <li><a href="?action=logoff"><i class="menu-icon icon-signout"></i>' . getRetText("odlhas", $_SESSION['message_set']) . '</a></li>
        </ul>
    </div>
    <!--/.sidebar-->
</div>
';

}else if($usertype == 2){
echo '
<div class="span3">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li class="active"><a href="index.php"><i class="menu-icon icon-dashboard"></i>' . getRetText("hlav", $_SESSION['message_set']) . '</a></li>
            <li><a href="transakce.php"><i class="menu-icon icon-bullhorn"></i>' . getRetText("transakce", $_SESSION['message_set']) . '</a></li>
            <li><a href="zpravy.php"><i class="menu-icon icon-inbox"></i>' . getRetText("zpravy", $_SESSION['message_set']) .'</a></li>
            <li><a href="akce.php"><i class="menu-icon icon-inbox"></i>'. getRetText("akce", $_SESSION['message_set']) . '</a></li>
            <li><a href="firmy.php"><i class="menu-icon icon-inbox"></i>'. getRetText("firmy", $_SESSION['message_set']) . '</a></li>
            <li><a href="admin.php"><i class="menu-icon icon-inbox"></i>Administrace</a></li>
        </ul>
        <!--/.widget-nav-->

        <!--/.widget-nav-->
        <ul class="widget widget-menu unstyled">
           <li><a href="?action=logoff"><i class="menu-icon icon-signout"></i>' . getRetText("odhlas", $_SESSION['message_set']) . '</a></li>
        </ul>
    </div>
    <!--/.sidebar-->
</div>
';

}
}

function MessageList($mode, $userid)
{
    $count = 0;
    if($mode == 1) {
    //přijaté
    $result = mysql_query('SELECT * FROM zpravy WHERE komu="' . $userid . '" ORDER BY kdy DESC') or die(mysql_error());
    while ($row = mysql_fetch_assoc($result)) 
    {
      echo '<tr class="';
      if($row['precteno'] == 1) echo "read"; else echo "unread";
      if($row['systemove'] == 1) echo " starred";
      echo '" ';
      echo 'onclick="document.location = '; echo "'zpravy.php?action=read&id=" . $row["id"] . "'"; echo '";';
      echo '>';
      echo '
              <td class="cell-icon">
                <i class="icon-star"></i>
              </td>
              <td class="cell-author hidden-phone hidden-tablet">
                ' . $row["od"] . '
              </td>
              <td class="cell-title">
                ' . $row["nazev"] . '
              </td>
              <td class="cell-time align-right">
                ' . date("D M j G:i", strtotime($row["kdy"])) . '
              </td>
            </tr>';
            $count ++;
      
    }
    if($count == 0) echo '<td colspan=6><center><b>'. getRetText("nomess", $_SESSION['message_set']) . '</b></center></td>';
    }
}

function createMsg($od, $komu, $nazev, $obsah, $systemove, $replyto){
try{
  $kratke = hash("adler32", "msg" . $nazev . $obsah . $systemove . $od . $komu);
  mysql_query("INSERT INTO zpravy (od, komu, nazev, obsah, systemove, kratky, odpoved_na, kdy) VALUES ('$od','$komu','$nazev','$obsah', '$systemove', '$kratke', '$replyto', NOW())") or die(mysql_error());
  return true;
}catch (Exception $e){
  echo $e;
return false;
}
}

function MarkRead($id)
{
    if(getMsgProperty($id, "precteno") == 1)
    {
    mysql_query("UPDATE zpravy SET precteno='1' WHERE id='" . $id ."';");
    }
}

function lng_menu()
{
echo '
										<div class="control-group">
											<label class="control-label" for="basicinput">'; getSystemText("zem", $_SESSION['message_set']);  echo '</label>
											<div class="controls">
												<select tabindex="1" data-placeholder="'; getSystemText("zem", $_SESSION['message_set']);  echo '" name="jazyk">
                        ';
$result = mysql_query('SELECT * FROM jazyky') or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) 
{
echo '<option value="' . $row['kod'] . '">' . $row['nazev'] . '</option>';
}                        
                        echo '
												</select>
											</div>
										</div>
';

}


      
?>