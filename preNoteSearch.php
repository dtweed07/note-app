<html>
<head>
<script type="text/javascript">
function byID(){
	location.href="idSearch.php"
}

function byPerson(){
	location.href="senderSearch.php"
}

function byStatus(){
	location.href="statusSearch.php"
}
</script>

<link rel="stylesheet" type="text/css" href="notes.css">
</head>

<body>
<center>
<div id="container">
<h1>How would you like to search?</h1>
<table>
<tr><td style="text-align:center"><input type="button" id="button" value="ID" onclick="byID()" style="width:140px; text-align:center"></td></tr>
<tr><td style="text-align:center"><input type="button" id="button" value="Sender/Receiver" onclick="byPerson()" style="width:140px; text-align:center"></td></tr>
<tr><td style="text-align:center"><input type="button" id="button" value="Status" onclick="byStatus()" style="width:140px; text-align:center"></td></tr>
</table>

<br>

<a href="index.php">
<img id="homeBtn" src="home.png">
</a>
</div><!--container div end-->
</center>
</body>
</html>