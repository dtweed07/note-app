<?php

if (isset($_POST["submit"])) {

   $file = "notes.xml";
   $fp = fopen($file, "rb") or die("Error - cannot open XML file");
   $str = fread($fp, filesize($file));

   $xml = new DOMDocument();
   $xml->formatOutput = true;
   $xml->preserveWhiteSpace = false;
   $xml->loadXML($str) or die("Error - cannot load XML data");

   // get document element
   $root= $xml->documentElement;
   $notes= $root->childNodes->item(0);

   // find first note element
   $firstNote=$notes->childNodes->item(0);
   $lastID=$firstNote->getAttribute("id");
   $newID=$lastID+1;

   // get values for new note element
   $newTitle=$_POST["title"];
   $newContent=$_POST["content"];
   $newSender=$_POST["sender"];
   $newReceiver=$_POST["receiver"];
   $newStatus=$_POST["status"];
   $newDate=$_POST["date"];
   $newUrl=$_POST["url"];
   
   // create the title element
   $titleNode=$xml->createElement("title");
   $titleTextNode=$xml->createTextNode("$newTitle");
   $titleNode->appendChild($titleTextNode);

   // create the content element
   $contentNode=$xml->createElement("content");
   $contentTextNode=$xml->createTextNode("$newContent");
   $contentNode->appendChild($contentTextNode);

   // create the sender element
   $senderNode=$xml->createElement("sender");
   $senderTextNode=$xml->createTextNode("$newSender");
   $senderNode->appendChild($senderTextNode);
   
   // create the receiver element
   $receiverNode=$xml->createElement("receiver");
   $receiverTextNode=$xml->createTextNode("$newReceiver");
   $receiverNode->appendChild($receiverTextNode);   
  
   // create the status element
   $statusNode=$xml->createElement("status");
   $statusTextNode=$xml->createTextNode("$newStatus");
   $statusNode->appendChild($statusTextNode);   

   // create the date element
   $dateNode=$xml->createElement("date");
   $dateTextNode=$xml->createTextNode("$newDate");
   $dateNode->appendChild($dateTextNode);      
   
   // create the url element
   $urlNode=$xml->createElement("url");
   $urlTextNode=$xml->createTextNode("$newUrl");
   $urlNode->appendChild($urlTextNode);
   
   // create the new book
   $newNoteNode=$xml->createElement("note");
   $newNoteNode->setAttribute("id",$newID);
   $newNoteNode->appendChild($titleNode);
   $newNoteNode->appendChild($contentNode);
   $newNoteNode->appendChild($senderNode);
   $newNoteNode->appendChild($receiverNode);
   $newNoteNode->appendChild($statusNode);
   $newNoteNode->appendChild($dateNode);
   $newNoteNode->appendChild($urlNode);

   // add new book to the data set
   $notes->insertBefore($newNoteNode,$firstNote);

   // output and save new XML file
   echo "<link rel='stylesheet' type='text/css' href='notes.css'>";
   echo "<script type='text/javascript'>function homeBtn(){ location.href='index.php'}</script>";
   echo "<center>";
   echo "<div id='container'>";
   echo "<h1>New Note</h1>";
   echo "<table>";
   echo "<tr><td style='width:100px'>ID: </td><td>".$newID."</td></tr>";
   echo "<tr><td style='width:100px'>Title: </td><td>".$newTitle."</td></tr>";
   echo "<tr><td style='width:100px'>Content: </td><td>".$newContent."</td></tr>";
   echo "<tr><td style='width:100px'>Sender: </td><td>".$newSender."</td></tr>";
   echo "<tr><td style='width:100px'>Receiver: </td><td>".$newReceiver."</td></tr>";
   echo "<tr><td style='width:100px'>Status: </td><td>".$newStatus."</td></tr>";
   echo "<tr><td style='width:100px'>Date: </td><td>".$newDate."</td></tr>";
   if($newUrl != ''){
	   echo "<tr><td style='width:100px'>URL: </td><td>".$newUrl."</td></tr>";
   }
   echo "</table>";
   echo "<a href='index.php'><img id='homeBtn' src='home.png'></a>";
   echo "</div>";
   echo "</center>";
   $xml->save("notes.xml");

} else {
?>
<html>
<head>
<title>Adding Notes</title>
<link rel="stylesheet" type="text/css" href="notes.css">
</head>

<body>
<center>
<div id="container">
<h1>Add New Note</h1>
<form method="post" action="addNote.php">
  <table>
  <tr><td style="width:100px">Title: </td><td style="width:100px"><input type="text" name="title" required></td></tr>
  <tr><td style="width:100px">Content: </td><td style="width:100px"><input type="text" name="content" required></td></tr>
  <tr><td style="width:100px">Sender: </td><td style="width:100px"><input type="text" name="sender" required></td></tr>
  <tr><td style="width:100px">Receiver(s): </td><td style="width:100px"><input type="text" name="receiver" required></td></tr>
  <tr><td style="width:100px">Date: </td><td style="width:100px"><input type="text" name="date" value="<?php echo date("d/m/Y")?>" readonly></td></tr>
  <tr><td style="width:100px">URL: </td><td style="width:100px"><input type="text" name="url"></td></tr>
  <tr><td style="width:100px"><input type="submit" name="submit" value="Add Note" id="button"></td><td>&nbsp;</td></tr>
  </table>
  <input type="hidden" id="status" name="status" value="New"/>
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
