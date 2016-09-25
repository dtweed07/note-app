<?php

if (isset($_POST["submit"])) {

   $file = "notes.xml";
   $fp = fopen($file, "rb") or die("cannot open file");
   $str = fread($fp, filesize($file));

   $xml = new DOMDocument();
   $xml->formatOutput = true;
   $xml->preserveWhiteSpace = false;
   $xml->loadXML($str) or die("Error");

   // original
   //echo "<xmp>OLD:\n". $xml->saveXML() ."</xmp>";

   // get document element
   $root= $xml->documentElement;
   $notes= $root->childNodes->item(0);
   
   // get change parameters
   $id=$_POST["id"];
   $newStatus=$_POST["status"];
   
   // find node and make the change
   foreach($notes->childNodes as $note) {
   
      if ($note->getAttribute("id")==$id) {
		  
       $sameTitle=$note->childNodes->item(0);
	   $sameContent=$note->childNodes->item(1);
	   $sameSender=$note->childNodes->item(2);
	   $sameReceiver=$note->childNodes->item(3);
	   $sameDate=$note->childNodes->item(5);
	   $sameURL=$note->childNodes->item(6);
	   
	   $statusNode=$xml->createElement("status");
       $statusTextNode=$xml->createTextNode("$newStatus");
       $statusNode->appendChild($statusTextNode);
	   
       $newNoteNode=$xml->createElement("note");
       $newNoteNode->setAttribute("id",$id);
       $newNoteNode->appendChild($sameTitle);
       $newNoteNode->appendChild($sameContent);
	   $newNoteNode->appendChild($sameSender);
	   $newNoteNode->appendChild($sameReceiver);
	   $newNoteNode->appendChild($statusNode);
	   $newNoteNode->appendChild($sameDate);
	   $newNoteNode->appendChild($sameURL);
       
       $notes->replaceChild($newNoteNode,$note);
      }
   }

   echo "<link rel='stylesheet' type='text/css' href='notes.css'>";
   echo "<script type='text/javascript'>";
   echo "function homeBtn(){ location.href='index.php'}";
   echo "</script>";
   echo "<center>";
   echo "<div id='container'>";
   if($id == $note->getAttribute("id")){
		echo "<h1>Updated Note</h1>";
		echo "<table>";
		echo "<tr><td style='width:100px'>ID: </td><td>".$id."</td></tr>";
		echo "<tr><td style='width:100px'>Title: </td><td>".$sameTitle->nodeValue."</td></tr>";
		echo "<tr><td style='width:100px'>Content: </td><td>".$sameContent->nodeValue."</td></tr>";
		echo "<tr><td style='width:100px'>Sender: </td><td>".$sameSender->nodeValue."</td></tr>";
		echo "<tr><td style='width:100px'>Receiver: </td><td>".$sameReceiver->nodeValue."</td></tr>";
		echo "<tr><td style='width:100px'>Status: </td><td><b>".$statusNode->nodeValue."</b></td></tr>";
		echo "<tr><td style='width:100px'>Date: </td><td>".$sameDate->nodeValue."</td></tr>";
		if($sameURL->nodeValue != ''){
			echo "<tr><td style='width:100px'>URL: </td><td>".$sameURL->nodeValue."</td></tr>";
		}
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
<title>Updating Notes</title>
<script type="text/javascript">
function validateForm(){
	var statusVal = document.forms["updateForm"]["status"].value;
	console.log(statusVal);
	if(statusVal == null || statusVal == ""){
		alert("Please use the values 'Current' or 'Historic' to update the note.");
		return false;
	}
	else if(statusVal == "Current" || statusVal == "Historic"){
		return true;
	}
	else {
		alert("Please use the values 'Current' or 'Historic' to update the note.");
		return false;
	}
}
</script>

<link rel="stylesheet" type="text/css" href="notes.css">
</head>

<body>
<center>
<div id="container">
<h1>Update Note</h1>
<form method="post" action="updateNote.php" name="updateForm" onsubmit="return validateForm()">
  <table>
  <tr><td style="width:100px">Note ID: </td><td style="width:100px"><input type="text" name="id" required></td></tr>
  <tr><td style="width:100px">New Status: </td><td style="width:100px"><input type="text" name="status" required></td></tr>
  <tr><td style="width:100px"><input type="submit" name="submit" value="Update Note" id="button"></td><td>&nbsp;</td></tr>
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
