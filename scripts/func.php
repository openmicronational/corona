<?php
session_start();

function database_open(){
$mysql = mysql_connect("wm39.wedos.net","w51970_bnk","e9m93WJk");
      mysql_select_db("d51970_bnk", $mysql);
      mysql_query("SET character_set_client=utf8");
      mysql_query("SET character_set_connection=utf8");
      mysql_query("SET character_set_results=utf8");
}
      
function getUsrProperty($id, $prop){
$result = mysql_query("SELECT * FROM usr WHERE id='$id';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
} 

function getZemProperty($zem, $prop){
$result = mysql_query("SELECT * FROM zem_dropdown WHERE nazev='$zem';") or die(mysql_error());
$runrows = mysql_fetch_assoc($result);
return $runrows[$prop];
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
$result = mysql_query("SELECT * FROM zem_dropdown") or die(mysql_error());
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
return date("d/m/Y H:i:s", $datetime);
//přidat čas
}

function DateDiffStr($d1, $d2)
{
$datetime1 = new DateTime($d1);

$datetime2 = new DateTime($d2);

$difference = $datetime1->diff($datetime2);

return '          '.$difference->y.' let, ' 
                   .$difference->m.' měsíců, ' 
                   .$difference->d.' dnů';
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
if(DateDiffD($row['kdy'], date('Y-m-d H:i:s')) < 2) $count++;
}
if($count == 0) return "Žádné";
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
echo $komu;
echo "<br>" . $zem1 . $porad1 . $typ1 . $inic1;
    $result = mysql_query("SELECT * FROM usr WHERE zem='$zem1' AND porad='$porad1' AND typ='$typ1' AND inicialy='$inic1';") or die(mysql_error());
    $num_rows = mysql_num_rows($result);
    if($num_rows == 1)
    {
      $runrows = mysql_fetch_assoc($result);
      $id1 = $runrows['id'];
      echo "<br>" . $id1;
      $zustatek1 = $runrows['balance'];
      $runrows = 0;
      $result = 0;
    }else{echo "příjemce neexistuje";return false;}
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
      echo "<br>" . $id2;
      $p = $runrows['pin'];
    }else{return false;}
    //další parametry
    echo "<br>" . $pin;
    echo "<br>" . $p;
    $pin = hash("sha256", $pin); 
    echo "<br>" . $pin;
    if($zustatek2 >= $castka)
    {
      if($p == $pin)
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
      
?>