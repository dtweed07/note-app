<?php
if (isset($_POST["submit"])) {
   
   $file = "notes.xml";
   $fp = fopen($file, "rb") or die("Error - cannot open XML file");
   $str = fread($fp, filesize($file));

   $xml = new DOMDocument();
   $xml->formatOutput = true;
   $xml->preserveWhiteSpace = false;
   $xml->loadXML($str) or die("Error - cannot load XML data");

   // display original XML file
   //echo "<xmp>OLD:\n". $xml->saveXML() ."</xmp>";

   // get document element
   $root= $xml->documentElement;
   $notes= $root->childNodes->item(0);

   // get element to delete
   $id=$_POST["id"];
   
   // find node and make the change
   foreach($notes->childNodes as $note) {
      if ($note->getAttribute("id")==$id) { 
          $notes->removeChild($note);
      }
   }

   // display new XML file
   //echo "<xmp>NEW:\n". $xml->saveXML() ."</xmp>";
   echo "<link rel='stylesheet' type='text/css' href='notes.css'>";
   echo "<script type='text/javascript'>function homeBtn(){ location.href='index.php'}</script>";
   echo "<center>";
   echo "<div id='container'>";
   if($id == $note->getAttribute("id")){
		echo "<h1>Success!</h1>";
		echo "<table>";
		echo "<tr><td>You have successfully deleted the note with the following details:-</td></tr>";
		echo "<tr><td style='text-align: center'>ID: ".$_POST['id']."</td></tr>";
		echo "</table>";
   }
   else {
	    echo "<h1>Sorry!</h1>";
	    echo "<table>";
	    echo "<tr><td>We couldn't find a note to match the following:-</td></tr>";
	    echo "<tr><td style='text-align: center'>ID: ".$_POST['id']."</td></tr>";
	    echo "</table>";
   }
   
   echo "<a href='index.php'><img id='homeBtn' src='home.png'></a>";
   echo "</div>";
   echo "</center>";

   $xml->save("notes.xml");

} else {
?>

<html>
<head>
<title>Delete Notes</title>
<script type="text/javascript">
function validateForm(){
	var idVal = document.forms["deleteForm"]["id"].value;
	console.log(idVal);
	if(idVal == null || idVal == ""){
		alert("Please enter the ID you wish to delete.");
		return false;
	}
	else return true;
}
</script>

<link rel="stylesheet" type="text/css" href="notes.css">
</head>

<body>
<center>
<div id="container">
<h1>Delete Note</h1>
<form method="post" action="deleteNote.php" name="deleteForm" onsubmit="return validateForm()">
  <table>
  <tr><td style="width:100px">Note ID: </td><td style="width:100px"><input type="text" name="id" required></td></tr>
  <tr><td style="width:100px"><input type="submit" name="submit" value="Delete Note" id="button"></td><td>&nbsp;</td></tr>
  </table>
</form>

<a href="index.php">
<img id="homeBtn" src="home.png">
</a>
</div><!--container div end-->
</center>
</body>

</html>
<?php
}
?>
