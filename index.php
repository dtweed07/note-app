<html>
<head>
<script type="text/javascript">

function addNote(){
	location.href="addNote.php"
}

function deleteNote(){
	location.href="deleteNote.php"
}

function searchNote(){
	location.href="preNoteSearch.php"
}

function updateNote(){
	location.href="updateNote.php"
}

</script>

<link rel="stylesheet" type="text/css" href="notes.css">
</head>

<body>
<center>
<div id="container">

<table>
<tr><td><h1>Assessment A - Note System</h1></td></tr>
<tr><td style="text-align:center"><input type="button" id="button" value="New Note" onclick="addNote()" style="width:140px; text-align:center"></td></tr>
<tr><td style="text-align:center"><input type="button" id="button" value="Update Note" onclick="updateNote()" style="width:140px; text-align:center"></td></tr>
<tr><td style="text-align:center"><input type="button" id="button" value="Search Notes"onclick="searchNote()" style="width:140px; text-align:center"></td></tr>
<tr><td style="text-align:center"><input type="button" id="button" value="Delete Note"onclick="deleteNote()" style="width:140px; text-align:center"></td></tr>
</table>

</div><!--container div end-->
</center>
</body>
</html>