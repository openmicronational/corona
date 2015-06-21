<html>
<body>
<?php
$mysql = mysql_connect("wm39.wedos.net","w51970_bnk","e9m93WJk")  or die(mysql_error());
mysql_select_db("d51970_bnk", $mysql) or die(mysql_error());
mysql_query("SET character_set_client=utf8");
mysql_query("SET character_set_connection=utf8");
mysql_query("SET character_set_results=utf8");
$query = mysql_query("SELECT * FROM `firma`;") or die(mysql_error());
if(mysql_num_rows($query) > 0)
{
	while($row = mysql_fetch_assoc($query) or die(mysql_error()))
	{
		$res = mysql_query("SELECT sum(kup_hodnota) FROM akcie WHERE firmy = " . $row["id"] . " ;");
		$res = mysql_fetch_assoc($res);
		echo $row["zeme"] . ";" . $row["zkratka"] . ";" . $res["sum(kup_hodnota)"] . ";";
	}
}

mysql_close();
?>
</body>
</html>