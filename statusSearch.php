<?php

if (isset($_POST["submit"])) {

   $file = "notes.xml";
   $fp = fopen($file, "rb") or die("cannot open file");
   $str = fread($fp, filesize($file));

   $xml = new DOMDocument();
   $xml->formatOutput = true;
   $xml->preserveWhiteSpace = false;
   $xml->loadXML($str) or die("Error");

   // get document element
   $root   = $xml->documentElement;
   $notes  = $root->childNodes->item(0);

   $notesFound=0;
   foreach($notes->childNodes as $note) {
	  $noteIDNode=$note->getAttribute("id");
      $noteTitleNode=$note->childNodes->item(0); 
      $noteContentNode=$note->childNodes->item(1);
	  $noteSenderNode=$note->childNodes->item(2);
      $noteReceiverNode=$note->childNodes->item(3); 
      $noteStatusNode=$note->childNodes->item(4);
      $noteDateNode=$note->childNodes->item(5); 
      $noteURLNode=$note->childNodes->item(6);  	  
      if ($noteStatusNode->nodeValue==$_POST["status"]) { //get the match of the post request
          echo "<link rel='stylesheet' type='text/css' href='notes.css'>";
		  echo "<script type='text/javascript'>function backBtn(){ location.href='preNoteSearch.php'}</script>";
		  echo "<center>";
		  echo "<div id='container'>";
		  echo "<h1>Status: ".$noteStatusNode->nodeValue."</h1>";
		  echo "<table>";
		  echo "<tr><td style='width:100px'>ID: </td><td>".$noteIDNode."</td></tr>";
		  echo "<tr><td style='width:100px'>Title: </td><td>".$noteTitleNode->nodeValue."</td></tr>";
		  echo "<tr><td style='width:100px'>Content: </td><td>".$noteContentNode->nodeValue."</td></tr>";
		  echo "<tr><td style='width:100px'>Sender: </td><td>".$noteSenderNode->nodeValue."</td></tr>";
		  echo "<tr><td style='width:100px'>Receiver: </td><td>".$noteReceiverNode->nodeValue."</td></tr>";
		  echo "<tr><td style='width:100px'>Date: </td><td>".$noteDateNode->nodeValue."</td></tr>";
		  if($noteURLNode->nodeValue != ''){
	          echo "<tr><td style='width:100px'>URL: </td><td>".$noteURLNode->nodeValue."</td></tr>";
          }
		  echo "</table>";
		  echo "<a href='preNoteSearch.php'><img id='backBtn' src='back.png'></a>";
		  echo "</div>";
		  echo "</center>";
          $notesFound++;
      }    
   }
   if ($notesFound==0) {
	  echo "<link rel='stylesheet' type='text/css' href='notes.css'>";
	  echo "<script type='text/javascript'>function backBtn(){ location.href='preNoteSearch.php'}</script>";
	  echo "<center>";
	  echo "<div id='container'>";
	  echo "<h1>Sorry!</h1>";
	  echo "<table>";
	  echo "<tr><td>We couldn't find a note to match the following:-</td></tr>";
	  echo "<tr><td style='text-align: center'>Status: ".$_POST['status']."</td></tr>";
	  echo "</table>";
	  echo "<a href='preNoteSearch.php'><img id='backBtn' src='back.png'></a>";
	  echo "</div>";
	  echo "</center>";
   }
   
} else {

?>

<html>
<head>
<title>Search Notes</title>
<link rel="stylesheet" type="text/css" href="notes.css">
<script type="text/javascript">
function validateForm(){
	var statusSearch = document.forms["searchStatus"]["status"].value;
	console.log(statusSearch);
	if(statusSearch == null || statusSearch == ""){
		alert("Please use the values 'New', 'Current' or 'Historic' to search notes.");
		return false;
	}
	else if(statusSearch == "New" || statusSearch == "Current" || statusSearch == "Historic"){
		return true;
	}
	else {
		alert("Please use the values 'New', 'Current' or 'Historic' to search notes.");
		return false;
	}
}
</script>
</head>

<body>
<center>
<div id="container">
<h1>Note Search</h1>
<form method="post" action="statusSearch.php" name="searchStatus"onsubmit="return validateForm()">
  <table>
  <tr><td style="width:100px">Status: </td><td style="width:100px"><input type="text" name="status" required></td></tr>
  <tr><td style="width:100px"><input type="submit" name="submit" value="Search" id="button"></td><td>&nbsp;</td></tr>
  </table>
</form>

<a href="preNoteSearch.php">
<img id="backBtn" src="back.png">
</a>
</div><!--container div end-->
</center>
</body>

</html>
<?php
}
?>