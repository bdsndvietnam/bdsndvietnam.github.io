<?php
require("ovikn.php");
require("func/mysql.php");
	$sql=query("SELECT sim1,giaban FROM simso limit 0, 5000");
	while ($row=fecth($sql))
	{
		$data.=$row['sim1']."	".$row['giaban']."
";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled 2</title>
<script>setTimeout("document.forms[0].submit()",10000);</script>
</head>

<body>

<form method="post" action="http://localhost/dangso.php">
<textarea name="TextArea1" cols="20" rows="2"><?=$data?></textarea>
		<input name="submit" type="submit" value="submit" />
		</form>


</body>

</html>
