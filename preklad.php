<?php
 include "func.php";
database_open();
?>
<html>    
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Překládací nástroj, UMSEBanka</title>
    </head>
    <body>
<?php

if($_GET['action'] == "send")
{
$id = $_GET['id'];
$result = mysql_query('SELECT * FROM systemove_zpravy WHERE message_set="0"') or die(mysql_error());
while ($row = mysql_fetch_assoc($result)) 
{
$msg = $_POST[$row['nazev']];
$nazev = $row['nazev'];
echo $msg . "<br>";
$query1 = "INSERT INTO systemove_zpravy (nazev, message_set, obsah) VALUES ('$nazev', '$id', '$msg')";
//mysql_query($query1) or die(mysql_error());
if(mysql_fetch_array(mysql_query('SELECT * FROM systemove_zpravy WHERE message_set="'. $id . ' AND obsah=' . $msg . ' AND nazev=' . $nazev . '"')) != false)
{
$query = "UPDATE systemove_zpravy SET obsah='". $msg ."' WHERE nazev='" . $nazev ."' AND message_set = '" . $id ."';";
}else{
$query = "INSERT INTO systemove_zpravy (nazev, message_set, obsah) VALUES ('$nazev', '$id', '$msg')";
}
mysql_query($query);
}

}else{
$id = $_GET['id'];
echo '<h3>' . getLngProperty($id, "nazev") . '</h3>';
echo '<form action="?action=send&id='. $id .'" method="POST">';
$result = mysql_query('SELECT * FROM systemove_zpravy WHERE message_set="0"') or die(mysql_error());
echo '<table>
<tr>
  <td>Zpráva</td>
  <td>Přelozena</td>
</tr>';
while ($row = mysql_fetch_assoc($result)) 
{
echo '<tr><td>' . $row['obsah'] . '</td><td><input type="text" name="' . $row['nazev'] . '" value="' . getRetText($row['nazev'], $id) . '"></td></tr>';
}
echo '</table>';
echo '<input type="submit">';
echo "</form>";

}

mysql_close();

?>
</body>
</html>