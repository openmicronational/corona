<?php

if(isset($_GET['a']))
{
  $action = htmlspecialchars($_GET['a'], ENT_QUOTES);
  if($action == "v") //verifikace, zda účet vůbec existuje
  {
    $zem = htmlspecialchars($_GET['zem'], ENT_QUOTES);
    $porad = htmlspecialchars($_GET['por'], ENT_QUOTES);
    $typ = htmlspecialchars($_GET['typ'], ENT_QUOTES);
    $inic = htmlspecialchars($_GET['inc'], ENT_QUOTES);  
    //bank.php?a=v&zem=LRK&por=1&typ=0&inic=AW
    //vráti 1, pokud-li existuje, nulu pokud ne
    if(is_numeric($porad) && is_numeric($typ) && !is_numeric($inic)  && !is_numeric($zem))
    {
      $mysql = mysql_connect("wm39.wedos.net","w51970_bnk","e9m93WJk");
      mysql_select_db("d51970_bnk", $mysql);
      mysql_query("SET character_set_client=utf8");
      mysql_query("SET character_set_connection=utf8");
      mysql_query("SET character_set_results=utf8");
      $result = mysql_query("SELECT * FROM usr WHERE zem='$zem' AND porad='$porad' AND typ='$typ' AND inicialy='$inic';") or die(mysql_error());
      $num_rows = mysql_num_rows($result);
      if($num_rows == 1) echo "1"; else echo "0";
      mysql_close($mysql);
    }
    else echo "CHYBA 0x01"; //0x01, spatne udaje
  }
  if($action == "t") //verifikace, zda účet vůbec existuje
  {           
    $mysql = mysql_connect("wm39.wedos.net","w51970_bnk","e9m93WJk");
    mysql_select_db("d51970_bnk", $mysql);
    mysql_query("SET character_set_client=utf8");
    mysql_query("SET character_set_connection=utf8");
    mysql_query("SET character_set_results=utf8");
    //1 = příjemce, obchod
    $zem1 = htmlspecialchars($_GET['zem1'], ENT_QUOTES);
    $porad1 = htmlspecialchars($_GET['por1'], ENT_QUOTES);
    $typ1 = htmlspecialchars($_GET['typ1'], ENT_QUOTES);
    $inic1 = htmlspecialchars($_GET['inc1'], ENT_QUOTES);
    //UID
    $result = mysql_query("SELECT * FROM usr WHERE zem='$zem1' AND porad='$porad1' AND typ='$typ1' AND inicialy='$inic1';") or die(mysql_error());
    $num_rows = mysql_num_rows($result);
    if($num_rows == 1)
    {
      $runrows = mysql_fetch_assoc($result);
      $id1 = $runrows['id'];
      $zustatek1 = $runrows['balance'];
      $runrows = 0;
      $result = 0;
    }else{echo "CHYBA 0x01";}
    //2 = odesílatel, klient
    $zem2 = htmlspecialchars($_GET['zem2'], ENT_QUOTES);
    $porad2 = htmlspecialchars($_GET['por2'], ENT_QUOTES);
    $typ2 = htmlspecialchars($_GET['typ2'], ENT_QUOTES);
    $inic2 = htmlspecialchars($_GET['inc2'], ENT_QUOTES);
    //UID
    $result = mysql_query("SELECT * FROM usr WHERE zem='$zem2' AND porad='$porad2' AND typ='$typ2' AND inicialy='$inic2';") or die(mysql_error());
    $num_rows = mysql_num_rows($result);
    if($num_rows == 1)
    {
      $runrows = mysql_fetch_assoc($result);
      $id2 = $runrows['id'];
      $zustatek2 = $runrows['balance'];
      $p = $runrows['pin'];
    }else{echo "CHYBA 0x01";}
    //další parametry
    $castka = htmlspecialchars($_GET['castka'], ENT_QUOTES);
    $pin = hash("sha256", htmlspecialchars($_GET['scr'], ENT_QUOTES));
    //http://b.lxo.cz/bank.php?a=t&zem1=UMS&por1=1&typ1=1&inc1=UB&zem2=LRK&por2=1&typ2=0&inc2=AW&castka=10&scr=7878&var=4242&spec=4242&komentar=Test
    
    $zem2 = htmlspecialchars($_GET['zem2'], ENT_QUOTES);
    $porad2 = htmlspecialchars($_GET['por2'], ENT_QUOTES);
    $typ2 = htmlspecialchars($_GET['typ2'], ENT_QUOTES);
    $inic2 = htmlspecialchars($_GET['inc2'], ENT_QUOTES);
    
    if($zustatek2 >= $castka)
    {
      if($p == $pin)
      {
        $var_symbol = htmlspecialchars($_GET['var'], ENT_QUOTES);
        $spec_symbol = htmlspecialchars($_GET['spec'], ENT_QUOTES);
        $komentar = htmlspecialchars($_GET['komentar'], ENT_QUOTES);
        $zustatek1 = $zustatek1 + $castka;
        $zustatek2 = $zustatek2 - $castka;
                
        $query = "UPDATE usr SET balance='" . $zustatek1 . "' WHERE id='" . $id1 ."';";
        mysql_query($query) or die(mysql_error());    
        
        $query = "UPDATE usr SET balance='" . $zustatek2 . "' WHERE id='" . $id2 ."';";
        mysql_query($query) or die(mysql_error());
        if($zem1 == $zem2) $mezinarodni = 0; else $mezinarodni = 1;
        mysql_query("INSERT INTO transakce (castka, odesilatel, prijemce, variabilni_symbol, komentar, kdy, mezinarodni, specialni_symbol) VALUES ('$castka','$id2','$id1','$var_symbol','$komentar', NOW(), '$mezinarodni', '$spec_symbol')") or die(mysql_error());
        
   
        echo "1";             
      } else echo "CHYBA 0x03"; 
    }else echo "CHYBA 0x02"; //nedostatek peněz
    mysql_close(); 
  }
  if($action == "l") //verifikace, zda účet vůbec existuje
  {
      $mysql = mysql_connect("wm39.wedos.net","w51970_bnk","e9m93WJk");
      mysql_select_db("d51970_bnk", $mysql);
      mysql_query("SET character_set_client=utf8");
      mysql_query("SET character_set_connection=utf8");
      mysql_query("SET character_set_results=utf8");
      $result = mysql_query("SELECT * FROM zem_dropdown") or die(mysql_error());
      while ($row = mysql_fetch_assoc($result)) 
      {
      echo '' . $row['nazev'] . '<br>' . $row['cely'] . '<br>';
      }                        
      mysql_close($mysql);
    }
} else echo "CHYBA 0x00"; //0x01, chybi get

?>