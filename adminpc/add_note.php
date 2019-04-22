<?php
session_start();
require("../ovikn.php");
require("../func/mysql.php");
$sql=mysql_query("SELECT * FROM my_order WHERE id='".$_GET['id']."'");
$row=mysql_fetch_array($sql);
?>
<h3 class="popupTitle">Add a new note</h3>

<!-- The preview: -->
<div id="previewNote" class="note yellow" style="left:0;top:65px;z-index:1">
	<div class="body"></div>
	<div class="author"></div>
	<span class="data"></span>
</div>

<div id="noteData"> <!-- Holds the form -->
<form action="" method="post" class="note-form">

<label for="note-body">Text of the note</label>
<textarea name="note-body" id="note-body" class="pr-body" cols="40" rows="2"></textarea>

<input type="hidden" name="note-name" id="note-name" class="pr-author" value="Sim:<?=$row['sosim']?> - Khách:<?=$row['dienthoai']?>-<?=$_SESSION['username']?>" />
<input type="hidden" name="note-mid" id="note-mid" value="<?=$_GET['id']?>" class="pr-mid" />

<label>Color</label> <!-- Clicking one of the divs changes the color of the preview -->
<div class="color yellow"></div>
<div class="color blue"></div>
<div class="color green"></div>

<!-- The green submit button: -->
<a id="note-submit" href="" class="green-button">Submit</a>

</form>
</div>
